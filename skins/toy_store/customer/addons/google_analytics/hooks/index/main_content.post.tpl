{* $Id: main_content.post.tpl 7387 2009-04-29 09:15:35Z lexa $ *}

{literal}
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	jQuery.getScript(gaJsHost + 'google-analytics.com/ga.js', function() {
		var pageTracker = _gat._getTracker("{/literal}{$addons.google_analytics.tracking_code}{literal}");
		pageTracker._initData();
		pageTracker._trackPageview();
	});
});
//]]>
</script>
{/literal}