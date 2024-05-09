<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php
	$getID = get_the_ID();
	$titlepostname = get_bloginfo('name') . ' | ' . get_the_title($getID);
	$titlepostname = rawurlencode($titlepostname);
	echo '<ul class="socialshare">
	<li><a class="soc-facebook-icon" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink($getID) . '" onclick="return !window.open(this.href, \'Share News\', \'width=500,height=500\')" target="_blank">
		<span class="visually-hidden">Share on Facebook, opens in new window</span>
		<svg viewBox="0 0 512 512"><path d="M211.9 197.4h-36.7v59.9h36.7V433.1h70.5V256.5h49.2l5.2-59.1h-54.4c0 0 0-22.1 0-33.7 0-13.9 2.8-19.5 16.3-19.5 10.9 0 38.2 0 38.2 0V82.9c0 0-40.2 0-48.8 0 -52.5 0-76.1 23.1-76.1 67.3C211.9 188.8 211.9 197.4 211.9 197.4z"></path></svg>
	</a></li>
	<li><a class="soc-x-icon" href="https://twitter.com/intent/tweet?text=' . ($titlepostname) . '%3A%20' . get_the_permalink($getID) . '" onclick="return !window.open(this.href, \'Share News\', \'width=500,height=500\')" target="_blank">
		<span class="visually-hidden">Share on X, opens in new window</span>	
		<svg viewBox="-140 -150 800 800"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg>
	</a></li>
	<li><a class="soc-linkedin-icon" href="http://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink($getID) . '&title=' . $titlepostname . '">
	<span class="visually-hidden">Share on LinkedIn</span>	
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M186.4 142.4c0 19-15.3 34.5-34.2 34.5 -18.9 0-34.2-15.4-34.2-34.5 0-19 15.3-34.5 34.2-34.5C171.1 107.9 186.4 123.4 186.4 142.4zM181.4 201.3h-57.8V388.1h57.8V201.3zM273.8 201.3h-55.4V388.1h55.4c0 0 0-69.3 0-98 0-26.3 12.1-41.9 35.2-41.9 21.3 0 31.5 15 31.5 41.9 0 26.9 0 98 0 98h57.5c0 0 0-68.2 0-118.3 0-50-28.3-74.2-68-74.2 -39.6 0-56.3 30.9-56.3 30.9v-25.2H273.8z"></path></svg>
	</a></li>
	<li><a class="soc-mail-icon" href="mailto:?subject=' . $titlepostname . '&amp;body=' . get_the_permalink($getID) . '&amp;story=' . $titlepostname . '">
	<span class="visually-hidden">Share with email, opens in email application</span>		
	<svg viewBox="0 0 512 512"><path d="M101.3 141.6v228.9h0.3 308.4 0.8V141.6H101.3zM375.7 167.8l-119.7 91.5 -119.6-91.5H375.7zM127.6 194.1l64.1 49.1 -64.1 64.1V194.1zM127.8 344.2l84.9-84.9 43.2 33.1 43-32.9 84.7 84.7L127.8 344.2 127.8 344.2zM384.4 307.8l-64.4-64.4 64.4-49.3V307.8z"></path></svg>
	</a></li>
	</ul>'
	?>
</div>