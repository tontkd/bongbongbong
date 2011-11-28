{* $Id: profiles_scripts.tpl 6646 2008-12-22 21:00:51Z zeke $ *}

<script type="text/javascript">
//<![CDATA[

// Message that will show if at least one of required fields isn't filled
var default_country = '{$settings.General.default_country|escape:javascript}';
var default_state = [];

{literal}
var zip_validators = {
	US: {
		regex: /^(\d{5})$/,
		format: '01342'
	},
	CA: {
		regex: /^(\w{3} \w{3})$/,
		format: 'K1A OB1'
	}
}
{/literal}

var states = new Array();
{if $states}
{foreach from=$states item=country_states key=country_code}
states['{$country_code}'] = new Array();
{foreach from=$country_states item=state name="fs"}
states['{$country_code}']['{$state.code|escape:quotes}'] = '{$state.state|escape:javascript}';
{/foreach}
{/foreach}
{/if}

//]]>
</script>
{script src="js/profiles_scripts.js"}
