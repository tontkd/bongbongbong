{* $Id: reports_add.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

<form action="{$index_script}" method="post" name="create_new" class="cm-form-highlight">

<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="details_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content" id="content_details_new">
		<div class="form-field">
			<label for="description" class="cm-required">{$lang.name}</label>
			<input type="text" name="add_report[0][description]" id="description" value="" size="40" class="input-text" />
		</div>
		
		<div class="form-field">
			<label for="position">{$lang.position_short}</label>
			<input type="text" name="add_report[0][position]" id="position" value="" size="3" class="input-text-short" />
		</div>
		
		<div class="form-field">
			<label for="status">{$lang.status}</label>
			<div class="select-field">
				<input type="radio" name="add_report[0][status]" id="status_a" checked="checked" value="A" class="radio" />
				<label for="status_a">{$lang.active}</label>
		
				<input type="radio" name="add_report[0][status]" id="status_d" value="D" class="radio" />
				<label for="status_d">{$lang.disabled}</label>
			</div>
		</div>
	</div>
</div>

<div class="buttons-container">
	{include file="buttons/create_cancel.tpl" but_name="dispatch[sales_reports.reports_list.add]" cancel_action="close"}
</div>
</form>

		