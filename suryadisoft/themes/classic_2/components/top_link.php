<?$links = WebContent::getLinks("Top");?>
<strong>
<? for ($i=0;$i<count($links);$i++) {
	$link = $links[$i];?>
	<? if ($link["target"] == "Self") {?>	
	<? if ($link["type"] == "Text") {?><? }?><a href="mystore.php?Page=Link&Link=<?=urlencode($link["url"])?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
	<? } else if ($link["target"] == "Parent") {?>
	<? if ($link["type"] == "Text") {?><? }?><a href="<?=$link["url"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
	<? } else if ($link["target"] == "New Window") {?>
	<? if ($link["type"] == "Text") {?><? }?><a href="<?=$link["url"]?>" target="<?=$link["target"]?>"><? if ($link["type"] == "Image") {?><img src="<?=$link["img_src"]?>" alt="<?=$link["text"]?>" border=0><? } else {?><?=$link["text"]?><? }?></a> <? if ($link["type"] == "Text" && $i < count($links)-1) {?>|<? }?>
	<? }?>
<? }?>
</strong>