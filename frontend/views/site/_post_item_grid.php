    <a class="ad-image" href="<?=''//$post->link?>">
        <img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>
        <img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>
    </a>
    <div class="ad-box-content">
        <a href="<?php //the_permalink(); ?>"><?php //$theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?></a>

        <div class="add-price"><span><?php //echo $post_price; ?></span></div>
    </div>