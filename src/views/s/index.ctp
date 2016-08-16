<?php
    $debug = false;
    $this->layout = 'slim';
?>

<style>
    .docs dl {
        width: 90%
    }

    .search div.input {
        width: 600px;
        text-align: right;
        margin: 0;
    }

    .search div.input input[type=text] {
        height: 40px;
        line-height: 40px;
    }

    .search div.submit {
        width: 100px;
        margin: 0;
    }
</style>

<form method="get" action="s">
    <div class="search cl">
        <div class="input z">
        	<input type="text" name="w" value="<?=$w?>">
        	<input type="hidden" name="fmt" value="html">
        </div>
        <div class="submit z"><input value="搜索" type="submit"></div>
    </div>
</form>

<div class="docs index">
    <table cellpadding="0" cellspacing="0">
        <?php $i = 0;
        foreach ($docs as $doc): ?>
            <div class="doc" >
                <dl><?php $i = 0; $class = ' class="altrow"' ?>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>标题</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['title']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>内容</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['shortContent']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>来源</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['provider']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>链接</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $this->Html->link($doc['url'], $doc['url'], ['target' => '_blank']) ?>
                        &nbsp;
                    </dd>
                    <?php if ($debug) : ?>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>调试信息</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <pre><?php // echo json_encode($doc, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?></pre>
                        &nbsp;
                    </dd>
                    <?php endif; ?>
                </dl>
            </div>
            <hr/>
        <?php endforeach; ?>
    </table>
</div>
