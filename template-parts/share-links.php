<?php
    $the_link = urlencode( get_the_permalink() );
    $image_base = get_stylesheet_directory_uri() . '/assets/img/social';
?>


<ul class="share-section-buttons clearfix">
	<li class="share-item share-item-facebook">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $the_link; ?>&t=" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;">
      <span class="a11y">Share on Facebook</span>
      <i class="l7icon-facebook"></i>
      <span></span>
    </a>
  </li>

	<li class="share-item share-item-twitter">
    <a href="https://twitter.com/intent/tweet?source=<?php echo $the_link; ?>&text=:%20<?php echo $the_link; ?>" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;">
      <span class="a11y">Share on Twitter</span>
      <i class="l7icon-twitter"></i>
      <span></span>
    </a>
  </li>

	<li class="share-item share-item-reddit">
    <a href="https://www.reddit.com/submit?url=<?php echo $the_link; ?>" target="_blank" title="Share on Reddit" onclick="window.open('https://www.reddit.com/submit?url=' + encodeURIComponent(document.URL)); return false;">
      <span class="a11y">Share on Reddit</span>
      <i class="l7icon-reddit"></i>
      <span></span>
    </a>
  </li>

	<!-- <li><a href="http://www.tumblr.com/share?v=3&u=<?php echo $the_link; ?>&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img alt="Post to Tumblr" src="<?php echo $image_base; ?>/Tumblr.svg"></a></li> -->

	<li class="share-item share-item-linkedin">
    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $the_link; ?>&title=&summary=&source=<?php echo $the_link; ?>" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;">
      <span class="a11y">Share on LinkedIn</span>
      <i class="l7icon-linkedin"></i>
      <span></span>
    </a>
  </li>

	<li class="share-item share-item-email">
    <a href="mailto:?subject=&body=:%20<?php echo $the_link; ?>" target="_blank" title="Send email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;">
      <span class="a11y">Share on Email</span>
      <i class="l7icon-envelope"></i>
      <span></span>
    </a>
  </li>
</ul>
