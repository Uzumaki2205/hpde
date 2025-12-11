<?php if (false){ ?>
<div class="search ">
    <input type="text" id="keyword" placeholder="<?=nhaptukhoatimkiem?>" onkeypress="doEnter(event,'keyword');" />
    <p onclick="onSearch('keyword');"><i class="fas fa-search"></i></p>
</div>
<!--  end search-normal -->
<?php } else { ?>
<div class="menu-search">
    <a href="javascript:void(0);" class="search-inOut">
        <i class="fa fa-search" aria-hidden="true"></i>
    </a>
</div>
<div class="search-form">
    <div class="form-row-search">
        <form action="search.html" method="GET" name="frm_search" id="frm_search" onsubmit="return false;">
            <input id="keyword" name="keyword" type="text" class="search-field" placeholder="<?=nhaptukhoatimkiem?>">
            <input id="defaultvalue" type="hidden" class="search-field" value="<?=nhaptukhoatimkiem?>">
            <input type="hidden" id="href_search" value="tim-kiem" />
        </form>
    </div>
</div>
<!-- end search-in-out -->
<?php } ?>