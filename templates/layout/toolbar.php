<!-- Begin Tool Fix Mobile -->
<section id="block-toolbar">
    <div class="container">
        <ul class="toolbar-box">
            <li>
                <a id="goidien" href="tel:<?php echo str_replace(array(',','.',' ','-'), '', $optsetting['dienthoai']) ?>" title="title">
                    <img src="assets/images/fp-phone.png" alt="images"><br>
                    <span>Gọi điện</span>
                </a>
            </li>
            <?php if (false): ?>
            <li>
                <a id="nhantin" href="sms:<?php echo str_replace(array(',','.',' ','-'), '', $optsetting['dienthoai']) ?>" title="title">
                    <img src="assets/images/fp-sms.png" alt="images"><br>
                    <span>Nhắn tin</span>
                </a>
            </li>
            <?php endif ?>
            <li>
                <a target="_blank" href="https://www.google.com/maps/dir/?api=1&amp;origin=&amp;destination=<?php echo $optsetting['diachi_'.$lang] ?>" title="Map">
                    <img src="assets/images/fp-chiduong.png" alt="images"><br>
                    <span>Chỉ Đường</span>
                </a>
            </li>
            <li>
                <a id="chatzalo" href="https://zalo.me/<?php echo str_replace(array(',','.',' ','-'), '', $optsetting['dienthoai']) ?>" title="title">
                    <img src="assets/images/fp-zalo.png" alt="images"><br>
                    <span>Zalo</span>
                </a>
            </li>
            <li>
                <a id="chatfb" href="<?=$optsetting['facebook']?>" title="title">
                    <img src="assets/images/fp-mess.png" alt="images"><br>
                    <span>Messenger</span>
                </a>
            </li>
        </ul>
    </div>
</section>
<!-- End Tool Fix Mobile -->