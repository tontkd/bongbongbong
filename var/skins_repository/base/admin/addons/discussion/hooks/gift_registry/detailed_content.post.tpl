{* $Id: detailed_content.post.tpl 6607 2008-12-18 22:39:44Z zeke $ *}

<div class="form-field">
	<label for="discussion_type">{$lang.discussion_title_giftreg}:</label>
	{assign var="discussion" value=$event_data.event_id|fn_get_discussion:"G"}
	<select name="event_data[discussion_type]" id="discussion_type">
		<option {if $discussion.type == "C"}selected="selected"{/if} value="C">{$lang.enabled}</option>
		<option {if $discussion.type == "D" || !$discussion}selected="selected"{/if} value="D">{$lang.disabled}</option>
	</select>
</div>
