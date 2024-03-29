<?php
	if (!defined('WM_ROOTPATH')) define('WM_ROOTPATH', (dirname(__FILE__).'/'));

	require_once(WM_ROOTPATH.'class_account.php');

	class MailProcessor
	{
		/**
		 * @var ImapStorage
		 */
		var $MailStorage = null;
		
		/**
		 * @var MySqlStorage
		 */
		var $DbStorage = null;
		
		/**
		 * @access private
		 * @var Account
		 */
		var $_account;
		
		/**
		 * @param Account $account
		 * @return MailProcessor
		 */
		function MailProcessor(&$account)
		{
			$this->_account = &$account;
			switch ($account->MailProtocol)
			{
				case MAILPROTOCOL_POP3:
					require_once(WM_ROOTPATH.'class_pop3storage.php');
					$this->MailStorage = &new Pop3Storage($account);
					break;
					
				case MAILPROTOCOL_IMAP4:
					require_once(WM_ROOTPATH.'class_imapstorage.php');
					$this->MailStorage = &new ImapStorage($account);
					break;
					
				case MAILPROTOCOL_WMSERVER:
					require_once(WM_ROOTPATH.'class_wmserverstorage.php');
					$this->MailStorage = &new WMserverStorage($account);
					break;
			}
			
			$this->DbStorage = &DbStorageCreator::CreateDatabaseStorage($account);
		}
		
		/**
		 * @param WebMailMessage $message
		 * @param string $from optional
		 * @param string $to optional
		 * @return bool
		 */
		function SendMail(&$message, $from = null, $to = null)
		{
			return CSmtp::SendMail($this->_account, $message, $from, $to);
		}
		
		/**
		 * @param FolderCollection $folders
		 * @return bool
		 */
		function Synchronize(&$folders)
		{
			$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
			$GLOBALS[MailOutputCharset] = $this->_account->DbCharset;
			
			return $this->MailStorage->Connect() && $this->MailStorage->Synchronize($folders);
		}
		
		/**
		 * @return bool
		 */
		function SynchronizeFolders()
		{
			return ($this->_account->MailProtocol == MAILPROTOCOL_IMAP4) &&
					$this->MailStorage->Connect() && $this->MailStorage->SynchronizeFolders();
		}
		
		/**
		 * @param string $messageIndex
		 * @param bool $indexAsUid
		 * @param Folder $folder
		 * @return WebMailMessage
		 */
		function GetMessageHeader($messageIndex, $indexAsUid, &$folder)
		{
			if ($folder->SyncType == FOLDERSYNC_DirectMode)
			{
				if ($this->MailStorage->Connect())
				{
					$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
					$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
				
					@ini_set('memory_limit', MEMORYLIMIT);
					@set_time_limit(TIMELIMIT);	
				
					return $this->MailStorage->LoadMessageHeader($messageIndex, $indexAsUid, $folder);
				}
			}
			return $this->DbStorage->LoadMessageHeader($messageIndex, $indexAsUid, $folder);
		}
		
		/**
		 * @param int $pageNumber
		 * @param Folder $folder optional
		 * @return WebMailMessageCollection
		 */
		function &GetMessageHeaders($pageNumber, &$folder)
		{
			$messageHeaders = null;
			
			@ini_set('memory_limit', MEMORYLIMIT);
			@set_time_limit(TIMELIMIT);
			
			if ($folder->SyncType == FOLDERSYNC_DirectMode)
			{
				if ($this->MailStorage->Connect())
				{
					$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
					$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
					$messageHeaders = &$this->MailStorage->LoadMessageHeaders($pageNumber, $folder);
				}
				return $messageHeaders;
			}
			
			if ($this->DbStorage->Connect())
			{
				$GLOBALS[MailDefaultCharset] = $this->_account->DbCharset;
				$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
				$messageHeaders = &$this->DbStorage->LoadMessageHeaders($pageNumber, $folder);
			}
			return $messageHeaders;
		}
		
		/**
		 * @param array $messageIdSet
		 * @param Folder $folder
		 * @return MessageCollection
		 */
		function GetMessages(&$messageIdUidSet, &$folder, $setRead = false)
		{
			$mailCollection = &new WebMailMessageCollection();
			
			$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
			$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();

			@ini_set('memory_limit', MEMORYLIMIT);
			@set_time_limit(TIMELIMIT);
			
			$messageIdSet = array_keys($messageIdUidSet);
			$messageUidSet = array_values($messageIdUidSet);
			
			for ($i = 0, $c = count($messageIdUidSet); $i < $c; $i++)
			{
				$messageId =& $messageIdSet[$i];
				$messageUid =& $messageUidSet[$i];
			
				if ($folder->SyncType == FOLDERSYNC_DirectMode)
				{
					if ($this->MailStorage->Connect())
					{	
						$mailMess = &$this->MailStorage->LoadMessage($messageUid, true, $folder);
					}
				}
				elseif ($this->DbStorage->Connect())
				{
					if ($this->DbStorage->GetMessageDownloadedFlag($messageId, $folder))
					{
						$mailMess = &$this->DbStorage->LoadMessage($messageId, false, $folder);
					}
					elseif ($this->MailStorage->Connect())
					{
						$mailMess = &$this->MailStorage->LoadMessage($messageUid, true, $folder);
					}
				}
				
				if ($setRead && $mailMess)
				{
					$mailMess->Flags = $mailMess->Flags | MESSAGEFLAGS_Seen;
				}
				
				$mailCollection->Add($mailMess);
				unset($mailMess);
			}
			
			return $mailCollection;	
		}
		
		
		/**
		 * @param int $messageId
		 * @param string $messageUid
		 * @param Folder $folder
		 * @return WebMailMessage
		 */
		function &GetMessage($messageId, $messageUid, &$folder)
		{
			$mailMess = null;
			$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
			$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();

			@ini_set('memory_limit', MEMORYLIMIT);
			@set_time_limit(TIMELIMIT);
			
			if ($folder->SyncType == FOLDERSYNC_DirectMode)
			{
				if ($this->MailStorage->Connect())
				{	
					$mailMess = &$this->MailStorage->LoadMessage($messageUid, true, $folder);
				}
			}
			elseif ($this->DbStorage->Connect())
			{
				if ($this->DbStorage->GetMessageDownloadedFlag($messageId, $folder))
				{
					$mailMess = &$this->DbStorage->LoadMessage($messageId, false, $folder);
				}
				elseif ($this->MailStorage->Connect())
				{
					$mailMess = &$this->MailStorage->LoadMessage($messageUid, true, $folder);
				}
			}
			
			return $mailMess;
		}
		
		/**
		 * @return FolderCollection
		 */
		function &GetFolders()
		{
			$folders = null;
			if ($this->DbStorage->Connect())
			{
				$folders = &$this->DbStorage->GetFolders();
			}
			return $folders;
		}
		
		/**
		 * @param Folder $folder
		 */
		function GetFolderMessageCount(&$folder)
		{
			if (!$folder)
			{
				return;
			}
			elseif ($folder->SyncType == FOLDERSYNC_DirectMode)
			{
				if ($this->MailStorage->Connect())
				{
					switch ($this->_account->MailProtocol)
					{
						case MAILPROTOCOL_IMAP4:
							$this->MailStorage->GetFolderMessageCount($folder);
							break;
							
						case MAILPROTOCOL_POP3:
							if ($folder->Type == FOLDERTYPE_Inbox)
							{
								$sizesArray = &$this->MailStorage->_getPop3Sizes();
								$folder->MessageCount = count($sizesArray);
							}
							else
							{
								$folder->MessageCount = 0;
							}
							$folder->UnreadMessageCount = 0;
							break;
							
						case MAILPROTOCOL_WMSERVER:
							if ($folder->Type == FOLDERTYPE_Inbox)
							{
								$folder->MessageCount = &$this->MailStorage->getAllMessagesCount();
							}
							else
							{
								$folder->MessageCount = 0;
							}
							$folder->UnreadMessageCount = 0;
							break;
					}

				}
			}
			elseif ($this->DbStorage->Connect())
			{
				$this->DbStorage->GetFolderMessageCount($folder);
			}
		}

		
		/**
		 * @param Folder $folder
		 */
		function GetFolderInfo(&$folder)
		{
			if ($this->DbStorage->Connect())
			{
				$this->DbStorage->GetFolderInfo($folder);
			}
		}
		
		/**
		 * @param Folder $folder
		 * @return bool
		 */
		function CreateFolder(&$folder, $forceCreate = false)
		{
			$result = true;
			if ($this->_account->MailProtocol == MAILPROTOCOL_IMAP4 && ($folder->SyncType != FOLDERSYNC_DontSync || $forceCreate))
			{
				$result &= $this->MailStorage->Connect() && $this->MailStorage->CreateFolder($folder);
			}

			return $result && $this->DbStorage->Connect() && $this->DbStorage->CreateFolder($folder);
		}
		
		/**
		 * @param Folder $folder
		 * @return bool
		 */
		function DeleteFolder(&$folder)
		{
			$result = $this->DbStorage->Connect();
			
			if (!$result)
			{
				return false;
			}
			
			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_IMAP4:
					if ($folder->SyncType != FOLDERSYNC_DontSync)
					{
						$result = $this->MailStorage->Connect() && $this->MailStorage->DeleteFolder($folder) &&
						$this->DbStorage->DeleteFolderFilters($folder->IdDb, $this->_account->Id);
					}
					return $result && $this->DbStorage->DeleteFolder($folder);
					
				case MAILPROTOCOL_POP3:
					$rootFolders = &$this->GetFolders();
					$folders = $rootFolders->CreateFolderListFromTree();
					
					foreach (array_keys($folders->Instance()) as $key)
					{
						$fld = &$folders->Get($key);
						if ($fld->IdDb == $folder->IdDb)
						{
							$this->_deletePop3FolderTree($fld, $result);
							return $result;
						}
					}
					return true;
					
				case MAILPROTOCOL_WMSERVER:
					$rootFolders = &$this->GetFolders();
					$folders = $rootFolders->CreateFolderListFromTree();
					
					foreach (array_keys($folders->Instance()) as $key)
					{
						$fld = &$folders->Get($key);
						if ($fld->IdDb == $folder->IdDb)
						{
							$this->_deletePop3FolderTree($fld, $result);
							return $result;
						}
					}
					return true;	
			}
			
			return false;
		}
		
		/**
		 * @param Folder $folderTree
		 * @param bool $folder
		 */
		function _deletePop3FolderTree(&$folderTree, $result)
		{
			if ($folderTree->SubFolders != null && $folderTree->SubFolders->Count())
			{
				foreach (array_keys($folderTree->SubFolders->Instance()) as $key)
				{
					$folder = &$folderTree->SubFolders->Get($key);
					$this->_deletePop3FolderTree($folder, $result);
				}
			}
			
			$result &= $this->PurgeFolder($folderTree);
			$result &= $this->DbStorage->DeleteFolder($folderTree);
			$result &= $this->DbStorage->DeleteFolderFilters($folderTree->IdDb, $this->_account->Id);
		}
		
		function SetHide(&$folder, $isHide)
		{
			$result = true;
			if ($this->_account->MailProtocol == MAILPROTOCOL_IMAP4 &&
				$folder->SyncType != FOLDERSYNC_DontSync && $folder->Type != FOLDERTYPE_Inbox)
			{
				$result &= $this->MailStorage->Connect() && $this->MailStorage->SubscribeFolder($folder, $isHide);
			}
			return $result;
		}
		
		/**
		 * @param Folder $folder
		 * @param string $newName
		 * @return bool
		 */
		function RenameFolder(&$folder, $newName, $delimiter)
		{
			$newName = str_replace($delimiter, '', $newName);
			// $newName = str_replace('&', '', $newName); bug in UTF-7-imap fix
			$pos = strrpos($folder->FullName, $delimiter);
			if ($pos === false)
			{
				$newFullName = $newName;
			}
			else
			{
				$folderParent = substr($folder->FullName, 0, $pos);
				$newFullName = $folderParent.$delimiter.$newName;
			}
			
			$result = true;
			$result &= $this->DbStorage->Connect() && $this->DbStorage->RenameFolder($folder, $newFullName);
			
			$fs = &new FileSystem(INI_DIR.'/mail', $this->_account->Email, $this->_account->Id);
			
			if ($fs->IsFolderExist($folder->FullName))
			{
				$result &= $fs->MoveSubFolders($folder->FullName, $newFullName);
			}
			
			if ($this->_account->MailProtocol == MAILPROTOCOL_IMAP4 && $folder->SyncType != FOLDERSYNC_DontSync)
			{
				$result &= $this->MailStorage->Connect() && $this->MailStorage->RenameFolder($folder, $newFullName);
			}
			
			return $result;
		}
		
		
		/**
		 * @param string $messageIdUidSet
		 * @param Folder $folder
		 * @param int $flags
		 * @param short $action
		 * @return bool
		 */
		function SetFlags(&$messageIdUidSet, &$folder, $flags, $action)
		{
			if ($messageIdUidSet != null)
			{
				$messageIdSet = array_keys($messageIdUidSet);
				$messageUidSet = array_values($messageIdUidSet);
			}
			else
			{
				$messageIdSet = null;
				$messageUidSet = null;
			}
			
			$result = true;
			
			if ($folder->SyncType != FOLDERSYNC_DirectMode)
			{
				if ($this->DbStorage->Connect())
				{
					$result &= $this->DbStorage->SetMessagesFlags($messageIdSet, false, $folder, $flags, $action);
				}	
			}
			
			if ($this->_account->MailProtocol == MAILPROTOCOL_IMAP4 && $folder->SyncType != FOLDERSYNC_DontSync)
			{
				if ($this->MailStorage->Connect())
				{
					$result &= $this->MailStorage->SetMessagesFlags($messageUidSet, true, $folder, $flags, $action);
				}
			}
			return $result;
		}
		
		/**
		 * @param Folder $folder
		 * @return bool
		 */
		function EmptyFolder(&$folder)
		{
			$result = true;

			$messageUidSet = array();
			if ($this->DbStorage->Connect())
			{
				$messageUidSet = $this->DbStorage->SelectAllMessagesUidSetByFolder($folder);
			}
			
			if ($folder->SyncType != FOLDERSYNC_DirectMode)
			{
				if ($this->DbStorage->Connect())
				{
					$result &= $this->DbStorage->PurgeFolder($folder, true);
					$result &= $this->DbStorage->UpdateMailboxSize();
				}
			}

			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_IMAP4:

					if ($folder->SyncType != FOLDERSYNC_DontSync)
					{
						if ($this->MailStorage->Connect())
						{
							$result &= $this->MailStorage->SetMessagesFlags($messageUidSet, true, $folder, MESSAGEFLAGS_Deleted, ACTION_Set);
							$result &= $this->MailStorage->PurgeFolder($folder);
						}
					}
					break;
				case MAILPROTOCOL_POP3:
				case MAILPROTOCOL_WMSERVER:
					if ($this->_account->MailMode == MAILMODE_DeleteMessageWhenItsRemovedFromTrash ||
							$this->_account->MailMode ==
								MAILMODE_KeepMessagesOnServerAndDeleteMessageWhenItsRemovedFromTrash)
					{
						$result &= $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUidSet, true, $folder);
					}
					break;		
			}
			//$fs->DeleteAccountDirs();
			return $result;
		}
		
		/**
		 * @param Folder $folder
		 * @return bool
		 */
		function PurgeFolder(&$folder)
		{
			$result = true;
			//$fs = new FileSystem(INI_DIR.'/temp', $this->_account->Email, $this->_account->Id);

			if ($this->_account->MailProtocol == MAILPROTOCOL_POP3 || $this->_account->MailProtocol == MAILPROTOCOL_WMSERVER)
			{
				$messageUidSet = array();
				if ($this->DbStorage->Connect())
				{
					$messageUidSet = $this->DbStorage->SelectAllMessagesUidSetByFolder($folder);
				}
			}
			
			if ($folder->SyncType != FOLDERSYNC_DirectMode)
			{
				if ($this->DbStorage->Connect())
				{
					$result &= $this->DbStorage->PurgeFolder($folder);
					$result &= $this->DbStorage->UpdateMailboxSize();
				}
			}

			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_IMAP4:

					if ($folder->SyncType != FOLDERSYNC_DontSync)
					{
						if ($this->MailStorage->Connect())
						{
							$result &= $this->MailStorage->PurgeFolder($folder);
						}
					}
					break;
				case MAILPROTOCOL_POP3:
				case MAILPROTOCOL_WMSERVER:
					if ($this->_account->MailMode == MAILMODE_DeleteMessageWhenItsRemovedFromTrash ||
							$this->_account->MailMode ==
								MAILMODE_KeepMessagesOnServerAndDeleteMessageWhenItsRemovedFromTrash)
					{
						$result &= $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUidSet, true, $folder);
					}
					break;		
			}
			//$fs->DeleteAccountDirs();
			return $result;
		}
		
		/**
		 * @param Array $messageIdUidSet
		 * @param Folder $folder optional
		 * @return bool
		 */
		function DeleteMessages(&$messageIdUidSet, &$folder)
		{
			$messageIdSet = array_keys($messageIdUidSet);
			$messageUidSet = array_values($messageIdUidSet);
			
			@set_time_limit(TIMELIMIT);
			//$fs = new FileSystem(INI_DIR.'/temp', $this->_account->Email, $this->_account->Id);
			
			$result = true;
			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_POP3:
					if ($folder->Type == FOLDERTYPE_Trash)
					{
						if ($folder->SyncType != FOLDERSYNC_DirectMode)
						{
							if ($this->DbStorage->Connect())
							{
								$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $folder);
								
								$result &= $this->DbStorage->UpdateMailboxSize();
							}
						}
				
						if ($this->_account->MailMode == MAILMODE_DeleteMessageWhenItsRemovedFromTrash ||
								$this->_account->MailMode ==
									MAILMODE_KeepMessagesOnServerAndDeleteMessageWhenItsRemovedFromTrash)
						{
							$result &= $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUidSet, true, $folder);
						}
							
						//$fs->DeleteAccountDirs();
						return $result;
					}
					elseif ($folder->SyncType == FOLDERSYNC_DirectMode)
					{
						//$fs->DeleteAccountDirs();
						return $result && $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUidSet, true, $folder);
					}
					
					$folderList = &$this->GetFolders();
					$trashFolder = &$folderList->GetFolderByType(FOLDERTYPE_Trash);
					
					//$fs->DeleteAccountDirs();
					return $this->MoveMessages($messageIdUidSet, $folder, $trashFolder);
					
				case MAILPROTOCOL_IMAP4:

					if (USEIMAPTRASH)
					{
						if ($folder->Type == FOLDERTYPE_Trash)
						{
							$result = true;
							$result &= $this->SetFlags($messageIdUidSet, $folder, MESSAGEFLAGS_Deleted, ACTION_Set);
							$result &= $this->PurgeFolder($folder);
							return $result;
						}
											
						$folderList = &$this->GetFolders();
						if ($folderList)
						{
							$trashFolder = &$folderList->GetFolderByType(FOLDERTYPE_Trash);	
							if ($trashFolder)
							{
								return $this->MoveMessages($messageIdUidSet, $folder, $trashFolder);		
							}
						}
						return false;
					}
					else
					{
						return $this->SetFlags($messageIdUidSet, $folder, MESSAGEFLAGS_Deleted, ACTION_Set);
					}
					
				case MAILPROTOCOL_WMSERVER:
					
					if ($folder->Type == FOLDERTYPE_Trash)
					{
						if ($folder->SyncType != FOLDERSYNC_DirectMode)
						{
							if ($this->DbStorage->Connect())
							{
								$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $folder);
								
								$result &= $this->DbStorage->UpdateMailboxSize();
							}
						}
				
						if ($this->_account->MailMode == MAILMODE_DeleteMessageWhenItsRemovedFromTrash ||
								$this->_account->MailMode ==
									MAILMODE_KeepMessagesOnServerAndDeleteMessageWhenItsRemovedFromTrash)
						{
							$result &= $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUidSet, true, $folder);
						}
						//$fs->DeleteAccountDirs();
						return $result;
					}
					elseif ($folder->SyncType == FOLDERSYNC_DirectMode)
					{
						//$fs->DeleteAccountDirs();
						return $result && $this->MailStorage->Connect() && $this->MailStorage->DeleteMessages($messageUidSet, true, $folder);
					}
					
					
					$folderList = &$this->GetFolders();
					$trashFolder = &$folderList->GetFolderByType(FOLDERTYPE_Trash);
					
					//$fs->DeleteAccountDirs();
					return $this->MoveMessages($messageIdUidSet, $folder, $trashFolder);
			}
		}
		
		/**
		 * @param Array $messageIdUidSet
		 * @param Folder $fromFolder
		 * @param Folder $toFolder
		 * @return bool
		 */
		function MoveMessages(&$messageIdUidSet, &$fromFolder, &$toFolder)
		{
			$GLOBALS[MailDefaultCharset] = $this->_account->DefaultIncCharset;
			$GLOBALS[MailOutputCharset] = $this->_account->DefaultOutCharset;
			
			$messageIdSet = array_keys($messageIdUidSet);
			$messageUidSet = array_values($messageIdUidSet);
			
			if (!$this->DbStorage->Connect() || !$this->MailStorage->Connect())
			{
				return false;
			}
			
			$result = true;
			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_POP3:
				case MAILPROTOCOL_WMSERVER:
					
					switch ($fromFolder->SyncType)
					{
						case FOLDERSYNC_DontSync:
							return $this->DbStorage->MoveMessages($messageIdSet, false, $fromFolder, $toFolder);	
							break;		
						default:
							$result = $this->DbStorage->SaveMessages($this->GetMessages($messageIdUidSet, $fromFolder), $toFolder);
							if ($result)
							{
								if ($result && $fromFolder->SyncType != FOLDERSYNC_DirectMode)
								{
									$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $fromFolder);
								}
								else
								{
									$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
								}
							}
							return $result;
							break;
					}					
					break;

				case MAILPROTOCOL_IMAP4:
					switch ($fromFolder->SyncType)
					{
						case FOLDERSYNC_DontSync:
							switch ($toFolder->SyncType)
							{
								case FOLDERSYNC_DontSync:
									return $this->DbStorage->MoveMessages($messageIdSet, false, $fromFolder, $toFolder);
									
								case FOLDERSYNC_AllEntireMessages:
								case FOLDERSYNC_AllHeadersOnly:
								case FOLDERSYNC_NewEntireMessages:
								case FOLDERSYNC_NewHeadersOnly:

									$result = $this->MailStorage->SaveMessages(
											$this->GetMessages($messageIdUidSet, $fromFolder), $toFolder);
									
									if ($result)
									{
										$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $fromFolder);
										$result &= $this->MailStorage->SynchronizeFolder($toFolder);
									}
									return $result;

								case FOLDERSYNC_DirectMode:
									$result = $this->MailStorage->SaveMessages(
											$this->DbStorage->LoadMessages($messageIdSet, false, $fromFolder), $toFolder);
									
									if ($result)
									{
										$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $fromFolder);
									}
									return $result;
											
							}
							break;
							
						case FOLDERSYNC_AllEntireMessages:
						case FOLDERSYNC_AllHeadersOnly:
						case FOLDERSYNC_NewEntireMessages:
						case FOLDERSYNC_NewHeadersOnly:
							switch ($toFolder->SyncType)
							{
								case FOLDERSYNC_DontSync:
									
									$result = $this->DbStorage->SaveMessages(
										$this->GetMessages($messageIdUidSet, $fromFolder), $toFolder);
									
									if ($result)
									{
										$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $fromFolder);
										$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
										
										if($this->MailStorage->PurgeUidFolder($fromFolder, $messageUidSet))
										{}
										elseif(!$this->MailStorage->PurgeFolder($fromFolder))
										{
											return false;
										}
									}
									
									return $result;
									
								case FOLDERSYNC_AllEntireMessages:
								case FOLDERSYNC_AllHeadersOnly:
								case FOLDERSYNC_NewEntireMessages:
								case FOLDERSYNC_NewHeadersOnly:
									$result = $this->MailStorage->CopyMessages($messageUidSet, true, $fromFolder, $toFolder);
									
									if ($result)
									{
										$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $fromFolder);
										$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
										
										if($this->MailStorage->PurgeUidFolder($fromFolder, $messageUidSet))
										{}
										elseif(!$this->MailStorage->PurgeFolder($fromFolder))
										{
											return false;
										}
										
										$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
										$GLOBALS[MailOutputCharset] = $this->_account->DbCharset;
										$result &= $this->MailStorage->SynchronizeFolder($toFolder);
									}
									return $result;
									
								case FOLDERSYNC_DirectMode:
									$result = $this->MailStorage->CopyMessages($messageUidSet, true, $fromFolder, $toFolder);

									if ($result)
									{
										$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $fromFolder);
										$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
										
										if($this->MailStorage->PurgeUidFolder($fromFolder, $messageUidSet))
										{}
										elseif (!$this->MailStorage->PurgeFolder($fromFolder))
										{
											return false;
										}
									}
									return $result;
							}
							break;
							
						case FOLDERSYNC_DirectMode:
							switch ($toFolder->SyncType)
							{
								case FOLDERSYNC_DontSync:
									$result = $this->DbStorage->SaveMessages(
											$this->GetMessages($messageIdUidSet, $fromFolder), $toFolder);

									if ($result)
									{
										$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
										if($this->MailStorage->PurgeUidFolder($fromFolder, $messageUidSet)) 
										{}
										elseif (!$this->MailStorage->PurgeFolder($fromFolder))
										{
											return false;
										}
									}
									return $result;
									
								case FOLDERSYNC_AllEntireMessages:
								case FOLDERSYNC_AllHeadersOnly:
								case FOLDERSYNC_NewEntireMessages:
								case FOLDERSYNC_NewHeadersOnly:
									$result = $this->MailStorage->CopyMessages($messageUidSet, true, $fromFolder, $toFolder);
									
									if ($result)
									{
										$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
										if($this->MailStorage->PurgeUidFolder($fromFolder, $messageUidSet))
										{}
										elseif (!$this->MailStorage->PurgeFolder($fromFolder))
										{
											return false;
										}

										$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
										$GLOBALS[MailOutputCharset] = $this->_account->DbCharset;
										$result &= $this->MailStorage->SynchronizeFolder($toFolder);
									}
									return $result;
									
								case FOLDERSYNC_DirectMode:
									$result = $this->MailStorage->CopyMessages($messageUidSet, true, $fromFolder, $toFolder);
									
									if ($result)
									{
										$result &= $this->MailStorage->DeleteMessages($messageUidSet, true, $fromFolder);
										if($this->MailStorage->PurgeUidFolder($fromFolder, $messageUidSet))
										{}
										elseif (!$this->MailStorage->PurgeFolder($fromFolder))
										{
											return false;
										}
									}
									return $result;
							}
							break;
					}
					
					if ($fromFolder->SyncType != FOLDERSYNC_DirectMode)
					{
						if ($this->DbStorage->Connect())
						{
							$result &= $this->DbStorage->DeleteMessages($messageIndexSet, $indexAsUid, $fromFolder, $toFolder);
						}
					}
					
					if ($fromFolder->SyncType != FOLDERSYNC_DontSync && $toFolder->SyncType != FOLDERSYNC_DontSync)
					{
						if ($this->MailStorage->Connect())
						{
							$result &= $this->MailStorage->MoveMessages($messageIndexSet, $indexAsUid, $fromFolder, $toFolder);
							$folders = &$this->GetFolders();
							$result &= $this->Synchronize($folders);
						}
						
					}
					break;
			}
			
			return $result;
		}
		
		/**
		 * @param string $condition
		 * @param FolderCollection $folders
		 * @param bool $inHeadersOnly
		 * @return int
		 */
		function SearchMessagesCount($condition, &$folders, $inHeadersOnly)
		{
			$messageCount = 0;
			if ($this->DbStorage->Connect())
			{
				$messageCount = $this->DbStorage->SearchMessagesCount($condition, $folders, $inHeadersOnly);
			}
			return $messageCount;
		}
				
		/**
		 * @param int $pageNumber
		 * @param string $condition
		 * @param FolderCollection $folders
		 * @param bool $inHeadersOnly
		 * @param int $countMessages
		 * @return WebMailMessageCollection
		 */
		function &SearchMessages($pageNumber, $condition, &$folders, $inHeadersOnly, $countMessages)
		{
			$webMailMessageCollection = null;
			if ($this->DbStorage->Connect())
			{
				$webMailMessageCollection = &$this->DbStorage->SearchMessages($pageNumber, $condition, $folders, $inHeadersOnly, $countMessages);
			}
			return $webMailMessageCollection;
		}
		
		/**
		 * @param WebMailMessage $message
		 * @param Folder $folder
		 * @return bool
		 */
		function UpdateMessage(&$message, &$folder)
		{
			if ($message == null || $folder == null)
			{
				return false;
			}
			
			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_POP3:
					$result = true;

					$size = $this->DbStorage->MessageSize($message, $folder);
					if ($size > -1)
					{
						$mailBoxesSize = $this->DbStorage->SelectMailboxesSize() - $size + $message->GetMailSize();
						if ($this->MailStorage->_settings->EnableMailboxSizeLimit && $this->_account->MailboxLimit < $mailBoxesSize)
						{
							setGlobalError(ErrorGetMailLimit);
							return false;
						}
						
						$result &= $this->DbStorage->UpdateMessage($message, $folder);
					}
					else
					{
						$message->IdMsg = $this->DbStorage->SelectLastIdMsg() + 1;
						$result &= $this->DbStorage->SaveMessage($message, $folder);
					}
					return $result;
					break;
				default:
					return $this->SaveMessage($message, $folder);
					break;
			}
			return false;
		}
		
		/**
		 * @param WebMailMessage $message
		 * @param Folder $folder
		 * @return bool
		 */
		function SaveMessage(&$message, &$folder, $fromFolder = null)
		{
			if ($message == null || $folder == null)
			{
				return false;
			}
			
			//Get size all messages in DB
			$mailBoxesSize = $this->DbStorage->SelectMailboxesSize() + $message->GetMailSize();
			$this->DbStorage->SelectMailboxesSize();	
			if ($this->MailStorage->_settings->EnableMailboxSizeLimit && $this->_account->MailboxLimit < $mailBoxesSize)
			{
				setGlobalError(ErrorGetMailLimit);
				return false;
			}
			
			switch ($this->_account->MailProtocol)
			{
				case MAILPROTOCOL_POP3:
					$result = true;
					if ($this->DbStorage->Connect())
					{
						//if ($message->IdMsg != -1)
						//{
							//$messageIdSet = array($message->IdMsg);
							//$result &= $this->DbStorage->DeleteMessages($messageIdSet, false, $folder);
						//}
						//else
						//{
						$message->IdMsg = $this->DbStorage->SelectLastIdMsg() + 1;
						//}
						return $result && $this->DbStorage->SaveMessage($message, $folder);
					}

				case MAILPROTOCOL_IMAP4:
					$result = true;
					
					if ($message->IdMsg != -1)
					{
						$messageIdUidSet = array();
						$messageIdUidSet[$message->IdMsg] = $message->Uid;
						$nfolder = ($fromFolder) ? $fromFolder : $folder;
						$result &= $this->DeleteMessages($messageIdUidSet, $nfolder);
					}
					
					if ($folder->SyncType != FOLDERSYNC_DontSync)
					{
						if ($this->MailStorage->Connect())
						{
							$result &= $this->MailStorage->SaveMessage($message, $folder);
							
							$GLOBALS[MailDefaultCharset] = $this->_account->GetDefaultIncCharset();
							unset($GLOBALS[MailInputCharset]);
							$GLOBALS[MailOutputCharset] = $this->_account->GetUserCharset();
							
							$result &= $this->MailStorage->SynchronizeFolder($folder);
						}
						return $result;
					}
					elseif ($this->DbStorage->Connect())
					{
						//if ($message->IdMsg == -1)
						//{
							$message->IdMsg = $this->DbStorage->SelectLastIdMsg() + 1;
						//}
						$result &= $this->DbStorage->SaveMessage($message, $folder);
						return $result;
					}
				
				case MAILPROTOCOL_WMSERVER:
					
					$result = true;
					if ($this->DbStorage->Connect())
					{
						$message->IdMsg = $this->DbStorage->SelectLastIdMsg() + 1;
						
						return $result && $this->DbStorage->SaveMessage($message, $folder);
					}	
			}
			return false;

		}
		
	}
