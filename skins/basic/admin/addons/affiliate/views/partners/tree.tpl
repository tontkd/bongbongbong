{* $Id: tree.tpl 7867 2009-08-20 11:09:56Z angel $ *}

{capture name="mainbox"}

{include file="addons/affiliate/views/partners/components/partner_tree.tpl" partners=$partners}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.affiliate_tiers_tree content=$smarty.capture.mainbox}
