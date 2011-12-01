{if (isset($block) and ((isset($block.text_id) and $block.text_id != "central_content" and $block_type == "B") or (!isset($block.text_id) and $id != "central"))) or (!isset($block) and $id == "0" and (!isset($block_type) or $block_type == "B"))}
        <script type="text/javascript">
        //<![CDATA[
            $('#{$location}_{$id}{$block_type}_block_object').bind('change', function() {literal}{{/literal}
                if($(this).val() == 'banners') {literal}{{/literal}
                    $('#{$location}_{$id}{$block_type}_id_use_magicslideshow_effect_on_banner_block').parent().css('display', 'block');
                {literal}}{/literal} else {literal}{{/literal}
                    $('#{$location}_{$id}{$block_type}_id_use_magicslideshow_effect_on_banner_block').val('No').parent().css('display', 'none');
                {literal}}{/literal}
            {literal}}{/literal});
        //]]>
        </script>
        <div class="form-field"{if $block.properties.list_object != 'banners'} style="display: none;"{/if}>
            <label for="{$location}_{$id}{$block_type}_id_use_magicslideshow_effect_on_banner_block">{$lang.magicslideshow_use_effect_on_banner_block}:</label>
            <select name="block[use_magicslideshow_effect_on_banner_block]" id="{$location}_{$id}{$block_type}_id_use_magicslideshow_effect_on_banner_block">
                <option value="Yes" {if $block.properties.use_magicslideshow_effect_on_banner_block == Yes}selected="selected"{/if}>Yes</option>
                <option value="No" {if !$block.properties.use_magicslideshow_effect_on_banner_block or $block.properties.use_magicslideshow_effect_on_banner_block == No}selected="selected"{/if}>No</option>
            </select>
        </div>
{/if}