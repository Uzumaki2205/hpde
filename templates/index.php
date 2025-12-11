<!DOCTYPE html>
<html lang="<?=$config['website']['lang-doc']?>">

<head>
    <?php include TEMPLATE.LAYOUT."head.php"; ?>
    <?php include TEMPLATE.LAYOUT."css.php"; ?>
</head>

<body>
    <div id="block-body" class="<?php if ($source!='index' ){echo 'not-index' ;} ?>">
        <header id="header">
            <?php
                include TEMPLATE.LAYOUT."seo.php";
                include TEMPLATE.LAYOUT."header.php";
                if($source=='index') include TEMPLATE.LAYOUT."slide.php";
                else include TEMPLATE.LAYOUT."breadcrumb.php"; 
            ?>
        </header>
        <main id="body">
            <?php include TEMPLATE.$template."_tpl.php"; ?>
        </main>
        <footer id="footer">
            <?php
                include TEMPLATE.LAYOUT."footer.php";
                include TEMPLATE.LAYOUT."modal.php";
                // if($deviceType=='mobile') include TEMPLATE.LAYOUT."phone.php";
                include TEMPLATE.LAYOUT."quick-tools.php";
            ?>
        </footer>
    </div>
    <?php include TEMPLATE.LAYOUT."js.php"; ?>
</body>

</html>