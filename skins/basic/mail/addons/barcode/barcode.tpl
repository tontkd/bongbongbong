{* $Id: barcode.tpl 6369 2008-11-20 10:54:05Z zeke $ *}

<img src="{$index_script}?dispatch=image.barcode.draw&amp;id={$id}&amp;type={$addons.barcode.type}&amp;width={$addons.barcode.width}&amp;height={$addons.barcode.height}&amp;xres={$addons.barcode.resolution}&amp;font={$addons.barcode.text_font}" alt="BarCode" width="{$addons.barcode.width}" height="{$addons.barcode.height}" />
