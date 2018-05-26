<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="settings_title"><h4><?php _e('Icon Settings',APMM_PRO_TD);?></h4></div>
  <div class="wpmm_mega_settings">
      <?php  if(isset($wpmmenu_item_meta['icons_settings']['icon_choose']) && $wpmmenu_item_meta['icons_settings']['icon_choose'] != ''){
						$attr_class = $wpmmenu_item_meta['icons_settings']['icon_choose']; 
						$style = 'display:block;';
						$check_icon = 1;
					}else{
					    $attr_class = ''; 
						$style = 'display:none;';
						$check_icon = 0;
					}
						?>

	<?php 
    $dashicons = array(
			        "blank",	// there is no "blank" but we need the option
					"menu",
					"admin-site",
					"dashboard",
					"admin-media",
					"admin-page",
					"admin-comments",
					"admin-appearance",
					"admin-plugins",
					"admin-users",
					"admin-tools",
					"admin-settings",
					"admin-network",
					"admin-generic",
					"admin-home",
					"admin-collapse",
					"admin-links",
					"format-links",
					"admin-post",
					"format-standard",
					"format-image",
					"format-gallery",
					"format-audio",
					"format-video",
					"format-chat",
					"format-status",
					"format-aside",
					"format-quote",
					"welcome-write-blog",
					"welcome-edit-page",
					"welcome-add-page",
					"welcome-view-site",
					"welcome-widgets-menus",
					"welcome-comments",
					"welcome-learn-more",
					"image-crop",
					"image-rotate-left",
					"image-rotate-right",
					"image-flip-vertical",
					"image-flip-horizontal",
					"undo",
					"redo",
					"editor-bold",
					"editor-italic",
					"editor-ul",
					"editor-ol",
					"editor-quote",
					"editor-alignleft",
					"editor-aligncenter",
					"editor-alignright",
					"editor-insertmore",
					"editor-spellcheck",
					"editor-distractionfree",
					"editor-kitchensink",
					"editor-underline",
					"editor-justify",
					"editor-textcolor",
					"editor-paste-word",
					"editor-paste-text",
					"editor-removeformatting",
					"editor-video",
					"editor-customchar",
					"editor-outdent",
					"editor-indent",
					"editor-help",
					"editor-strikethrough",
					"editor-unlink",
					"editor-rtl",
					"align-left",
					"align-right",
					"align-center",
					"align-none",
					"lock",
					"calendar",
					"visibility",
					"post-status",
					"post-trash",
					"edit",
					"trash",
					"arrow-up",
					"arrow-down",
					"arrow-left",
					"arrow-right",
					"arrow-up-alt",
					"arrow-down-alt",
					"arrow-left-alt",
					"arrow-right-alt",
					"arrow-up-alt2",
					"arrow-down-alt2",
					"arrow-left-alt2",
					"arrow-right-alt2",
					"leftright",
					"sort",
					"list-view",
					"exerpt-view",
					"share",
					"share1",
					"share-alt",
					"share-alt2",
					"twitter",
					"rss",
					"facebook",
					"facebook-alt",
					"networking",
					"googleplus",
					"hammer",
					"art",
					"migrate",
					"performance",
					"wordpress",
					"wordpress-alt",
					"pressthis",
					"update",
					"screenoptions",
					"info",
					"cart",
					"feedback",
					"cloud",
					"translation",
					"tag",
					"category",
					"yes",
					"no",
					"no-alt",
					"plus",
					"minus",
					"dismiss",
					"marker",
					"star-filled",
					"star-half",
					"star-empty",
					"flag",
					"location",
					"location-alt",
					"camera",
					"images-alt",
					"images-alt2",
					"video-alt",
					"video-alt2",
					"video-alt3",
					"vault",
					"shield",
					"shield-alt",
					"search",
					"slides",
					"analytics",
					"chart-pie",
					"chart-bar",
					"chart-line",
					"chart-area",
					"groups",
					"businessman",
					"id",
					"id-alt",
					"products",
					"awards",
					"forms",
					"portfolio",
					"book",
					"book-alt",
					"download",
					"upload",
					"backup",
					"lightbulb",
					"smiley");
$font_awesome_icons = array("500px","adjust","adn","align-center","align-justify","align-left","align-right","amazon","ambulance","american-sign-language-interpreting","anchor","android","angellist","angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","apple","archive","area-chart","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows","arrows-alt","arrows-h","arrows-v","assistive-listening-systems","asterisk","at","audio-description","backward","balance-scale","ban","bandcamp","bar-chart","barcode","bars","bath","battery-empty","battery-full","battery-half","battery-quarter","battery-three-quarters","bed","beer","behance","behance-square","bell","bell-o","bell-slash","bell-slash-o","bicycle","binoculars","birthday-cake","bitbucket","bitbucket-square","black-tie","blind","bluetooth","bluetooth-b","bold","bolt","bomb","book","bookmark","bookmark-o","braille","briefcase","btc","bug","building","building-o","bullhorn","bullseye","bus","buysellads","calculator","calendar","calendar-check-o","calendar-minus-o","calendar-o","calendar-plus-o","calendar-times-o","camera","camera-retro","car","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","cart-arrow-down","cart-plus","cc","cc-amex","cc-diners-club","cc-discover","cc-jcb","cc-mastercard","cc-paypal","cc-stripe","cc-visa","certificate","chain-broken","check","check-circle","check-circle-o","check-square","check-square-o","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","child","chrome","circle","circle-o","circle-o-notch","circle-thin","clipboard","clock-o","clone","cloud","cloud-download","cloud-upload","code","code-fork","codepen","codiepie","coffee","cog","cogs","columns","comment","comment-o","commenting","commenting-o","comments","comments-o","compass","compress","connectdevelop","contao","copyright","creative-commons","credit-card","credit-card-alt","crop","crosshairs","css3","cube","cubes","cutlery","dashcube","database","deaf","delicious","desktop","deviantart","diamond","digg","dot-circle-o","download","dribbble","dropbox","drupal","edge","eercast","eject","ellipsis-h","ellipsis-v","empire","envelope","envelope-open-o","envelope-square","envira","eraser","etsy","eur","exchange","exclamation","exclamation-circle","exclamation-triangle","expand","expeditedssl","external-link","external-link-square","eye","eye-slash","eyedropper","facebook","facebook-official","facebook-square","fast-backward","fast-forward","fax","female","fighter-jet","file","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-o","file-pdf-o","file-powerpoint-o","file-text","file-text-o","file-video-o","file-word-o","files-o","film","filter","fire","fire-extinguisher","firefox","first-order","flag","flag-checkered","flag-o","flask","flickr","floppy-o","folder","folder-o","folder-open","folder-open-o","font","font-awesome","fonticons","fort-awesome","forumbee","forward","foursquare","free-code-camp","frown-o","futbol-o","gamepad","gavel","gbp","genderless","get-pocket","gg","gg-circle","gift","git","git-square","github","github-alt","github-square","gitlab","glass","glide","glide-g","globe","google","google-plus","google-plus-official","google-plus-square","google-wallet","graduation-cap","gratipay","grav","h-square","hacker-news","hand-lizard-o","hand-o-down","hand-o-left","hand-o-right","hand-o-up","hand-paper-o","hand-peace-o","hand-pointer-o","hand-rock-o","hand-scissors-o","hand-spock-o","hashtag","hdd-o","header","headphones","heart","heart-o","heartbeat","history","home","hospital-o","hourglass","hourglass-end","hourglass-half","hourglass-o","hourglass-start","houzz","html5","i-cursor","id-badge","id-card","id-card-o","ils","imdb","inbox","indent","industry","info","info-circle","inr","instagram","internet-explorer","ioxhost","italic","joomla","jpy","jsfiddle","key","keyboard-o","krw","language","laptop","lastfm","lastfm-square","leaf","leanpub","lemon-o","level-down","level-up","life-ring","lightbulb-o","line-chart","link","linkedin","linkedin-square","linux","list","list-alt","list-ol","list-ul","location-arrow","lock","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","low-vision","magic","magnet","male","map","map-marker","map-o","map-pin","map-signs","mars","mars-double","mars-stroke","mars-stroke-h","mars-stroke-v","maxcdn","meanpath","medium","medkit","meetup","meh-o","mercury","microchip","microphone","microphone-slash","minus","minus-circle","minus-square","minus-square-o","mixcloud","mobile","modx","money","moon-o","motorcycle","mouse-pointer","music","neuter","newspaper-o","object-group","object-ungroup","odnoklassniki","odnoklassniki-square","opencart","openid","opera","optin-monster","outdent","pagelines","paint-brush","paper-plane","paper-plane-o","paperclip","paragraph","pause","pause-circle","pause-circle-o","paw","paypal","pencil","pencil-square","pencil-square-o","percent","phone","phone-square","picture-o","pie-chart","pied-piper","pied-piper-alt","pied-piper-pp","pinterest","pinterest-p","pinterest-square","plane","play","play-circle","play-circle-o","plug","plus","plus-circle","plus-square","plus-square-o","podcast","power-off","print","product-hunt","puzzle-piece","qq","qrcode","question","question-circle","question-circle-o","quora","quote-left","quote-right","random","ravelry","rebel","recycle","reddit","reddit-alien","reddit-square","refresh","registered","renren","repeat","reply","reply-all","retweet","road","rocket","rss","rss-square","rub","safari","scissors","scribd","search","search-minus","search-plus","sellsy","server","share","share-alt","share-alt-square","share-square","share-square-o","shield","ship","shirtsinbulk","shopping-bag","shopping-basket","shopping-cart","shower","sign-in","sign-language","sign-out","signal","simplybuilt","sitemap","skyatlas","skype","slack","sliders","slideshare","smile-o","snapchat","snapchat-ghost","snapchat-square","snowflake-o","sort","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-asc","sort-desc","sort-numeric-asc","sort-numeric-desc","soundcloud","space-shuttle","spinner","spoon","spotify","square","square-o","stack-exchange","stack-overflow","star","star-half","star-half-o","star-o","steam","steam-square","step-backward","step-forward","stethoscope","sticky-note","sticky-note-o","stop","stop-circle","stop-circle-o","street-view","strikethrough","stumbleupon","stumbleupon-circle","subscript","subway","suitcase","sun-o","superpowers","superscript","table","tablet","tachometer","tag","tags","tasks","taxi","telegram","television","tencent-weibo","terminal","text-height","text-width","th","th-large","th-list","themeisle","thermometer-empty","thermometer-full","thermometer-half","thermometer-quarter","thermometer-three-quarters","thumb-tack","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","ticket","times","times-circle","times-circle-o","tint","toggle-off","toggle-on","trademark","train","transgender","transgender-alt","trash","trash-o","tree","trello","tripadvisor","trophy","truck","try","tty","tumblr","tumblr-square","twitch","twitter","twitter-square","umbrella","underline","undo","universal-access","university","unlock","unlock-alt","upload","usb","usd","user","user-md","user-o","user-plus","user-secret","user-times","users","venus","venus-double","venus-mars","viacoin","viadeo","viadeo-square","video-camera","vimeo","vimeo-square","vine","vk","volume-control-phone","volume-down","volume-off","volume-up","weibo","weixin","whatsapp","wheelchair","wheelchair-alt","wifi","wikipedia-w","window-close","window-close-o","window-maximize","window-minimize","window-restore","windows","wordpress","wpbeginner","wpexplorer","wpforms","wrench","xing","xing-square","y-combinator","yahoo","yelp","yoast","youtube","youtube-play","youtube-square");


			$genericon_icon = array(
				"blank",
				"standard",
				"aside",
				"image",
				"gallery",
				"video",
				"status",
				"quote",
				"link",
				"chat",
				"audio",

				/* Social icons */
				"github",
				"dribbble",
				"twitter",
				"facebook",
				"facebook-alt",
				"wordpress",
				"googleplus",
				"linkedin",
				"linkedin-alt",
				"pinterest",
				"pinterest-alt",
				"flickr",
				"vimeo",
				"youtube",
				"tumblr",
				"instagram",
				"codepen",
				"polldaddy",
				"googleplus-alt",
				"path",
				"skype",
				"digg",
				"reddit",
				"stumbleupon",
				"pocket",

				/* Meta icons */
				"comment",
				"category",
				"tag",
				"time",
				"user",
				"day",
				"week",
				"month",
				"pinned",

				/* Other icons */
				"search",
				"unzoom",
				"zoom",
				"show",
				"hide",
				"close",
				"close-alt",
				"trash",
				"star",
				"home",
				"mail",
				"edit",
				"reply",
				"feed",
				"warning",
				"share",
				"attachment",
				"location",
				"checkmark",
				"menu",
				"refresh",
				"minimize",
				"maximize",
				"404",
				"spam",
				"summary",
				"cloud",
				"key",
				"dot",
				"next",
				"previous",
				"expand",
				"collapse",
				"dropdown",
				"dropdown-left",
				"top",
				"draggable",
				"phone",
				"send-to-phone",
				"plugin",
				"cloud-download",
				"cloud-upload",
				"external",
				"document",
				"book",
				"cog",
				"unapprove",
				"cart",
				"pause",
				"stop",
				"skip-back",
				"skip-ahead",
				"play",
				"tablet",
				"send-to-tablet",
				"info",
				"notice",
				"help",
				"fastforward",
				"rewind",
				"portfolio",
				"heart",
				"code",
				"subscribe",
				"unsubscribe",
				"subscribed",
				"reply-alt",
				"reply-single",
				"flag",
				"print",
				"lock",
				"bold",
				"italic",
				"picture",

				/* Generic shapes */
				"uparrow",
				"rightarrow",
				"downarrow",
				"leftarrow",
				"genericon-videocamera",
				"genericon-rating-empty"
				);



  // $flaticons = array(
		// 		"flaticon-alien","flaticon-ambulance","flaticon-ambulance-1","flaticon-aries","flaticon-armchair","flaticon-baby","flaticon-baby-1","flaticon-baby-girl","flaticon-back","flaticon-balance","flaticon-bar-chart","flaticon-bar-chart-1","flaticon-battery","flaticon-battery-1","flaticon-battery-2","flaticon-battery-3","flaticon-battery-4","flaticon-bedside-table","flaticon-beer","flaticon-binoculars","flaticon-blind","flaticon-book","flaticon-cancer","flaticon-car","flaticon-car-1","flaticon-car-2","flaticon-center-alignment","flaticon-center-alignment-1","flaticon-chicken","flaticon-chicken-1","flaticon-chicken-2","flaticon-clock","flaticon-clock-1","flaticon-clock-2","flaticon-clock-3","flaticon-clock-4","flaticon-cloud","flaticon-cloud-1","flaticon-cloud-2","flaticon-cloud-computing","flaticon-cloudy","flaticon-coins","flaticon-compass","flaticon-conga","flaticon-copy","flaticon-corndog","flaticon-cow","flaticon-customer-service","flaticon-cutlery","flaticon-diagonal-arrow","flaticon-diagonal-arrow-1","flaticon-diagonal-arrow-2","flaticon-diagonal-arrow-3","flaticon-diamond","flaticon-diaper","flaticon-download","flaticon-download-1","flaticon-electric-guitar","flaticon-emoticon","flaticon-export","flaticon-eye","flaticon-eye-1","flaticon-feeding-bottle","flaticon-file","flaticon-file-1","flaticon-file-2","flaticon-file-3","flaticon-film-strip","flaticon-flag","flaticon-flash","flaticon-fork","flaticon-fountain-pen","flaticon-fountain-pen-1","flaticon-fountain-pen-2","flaticon-fountain-pen-3","flaticon-fountain-pen-4","flaticon-gemini","flaticon-glass-of-water","flaticon-guitar","flaticon-ham","flaticon-happy","flaticon-happy-1","flaticon-head","flaticon-heavy-metal","flaticon-home","flaticon-home-1","flaticon-home-2","flaticon-home-3","flaticon-home-4","flaticon-horse","flaticon-id-card","flaticon-jar","flaticon-justify","flaticon-laundry","flaticon-laundry-1","flaticon-laundry-2","flaticon-laundry-3","flaticon-laundry-4","flaticon-laundry-5","flaticon-left-alignment","flaticon-left-alignment-1","flaticon-lemon","flaticon-lemon-1","flaticon-lemonade","flaticon-lemonade-1","flaticon-leo","flaticon-light-bulb","flaticon-like","flaticon-mail","flaticon-mail-1","flaticon-mail-2","flaticon-mail-3","flaticon-mail-4","flaticon-mail-5","flaticon-man","flaticon-man-1","flaticon-map","flaticon-maths","flaticon-medical-result","flaticon-money","flaticon-monitor","flaticon-monitor-1","flaticon-monitor-2","flaticon-monitor-3","flaticon-monitor-4","flaticon-monitor-5","flaticon-muted","flaticon-next","flaticon-ninja","flaticon-padlock","flaticon-padlock-1","flaticon-pear","flaticon-phone-call","flaticon-phone-call-1","flaticon-phone-call-2","flaticon-phone-call-3","flaticon-photo-camera","flaticon-pie-chart","flaticon-pie-chart-1","flaticon-piggy-bank","flaticon-pin","flaticon-placeholder","flaticon-placeholder-1","flaticon-placeholder-2","flaticon-plug","flaticon-plug-1","flaticon-pointing","flaticon-rain","flaticon-right-alignment","flaticon-right-alignment-1","flaticon-rolling-pin","flaticon-ruler","flaticon-ruler-1","flaticon-sad","flaticon-saturn","flaticon-saturn-1","flaticon-sausage","flaticon-sheep","flaticon-sheep-1","flaticon-shield","flaticon-shop","flaticon-shopping-bag","flaticon-shopping-basket","flaticon-smartphone","flaticon-smartphone-1","flaticon-smartphone-2","flaticon-smartphone-3","flaticon-smile","flaticon-socket","flaticon-speech-bubble","flaticon-speech-bubble-1","flaticon-speech-bubble-2","flaticon-speech-bubble-3","flaticon-spoon","flaticon-sun","flaticon-surprised","flaticon-syringe","flaticon-table","flaticon-tap","flaticon-tap-1","flaticon-tap-2","flaticon-taurus","flaticon-telephone","flaticon-toaster","flaticon-ufo","flaticon-upload","flaticon-upload-1","flaticon-van","flaticon-victory","flaticon-video-camera","flaticon-video-camera-1","flaticon-watermelon","flaticon-weight","flaticon-wifi","flaticon-wifi-1","flaticon-wifi-2","flaticon-wifi-3","flaticon-woman","flaticon-woman-1","flaticon-zip"
		// 		);
//   echo count($font_awesome_icons);//665
// echo count($genericon_icon);//125
// echo count($dashicons);// 165
		?>



       <table class="widefat">
           <tr>
				 <td class="wpmm_meta_table" style="width: 119px;"><label for="show_top_content"><?php _e("Choose Icon", APMM_PRO_TD) ?></label></td>
				  <td> 
				       <div class="topicons">

				           <input class="wpmm-icon-picker" type="hidden" id="icon_picker_icon1" name="wpmm_settings[icons_settings][icon_choose]" id="selected_font_icon" 
											value="<?php echo $attr_class;?>"/>
							<div class="icon-preview">
								<i class="<?php if( isset( $attr_class ) ) { $v=explode('|',$attr_class); echo $v[0].' '.$v[1]; } ?>"></i>
							</div>
							<div class="icon-main">
							<input type="hidden" id="current_selection" value="fontawesome"/>
								<select class="select-icon">
									<option value="1"><?php _e('Font Awesome Icons',APMM_PRO_TD);?></option>
									<option value="2"><?php _e('Generic Icons',APMM_PRO_TD);?></option>
									<option value="3"><?php _e('DashIcons',APMM_PRO_TD);?></option>
									<!-- <option value="4">< ?php _e('FlatIcons',APMM_PRO_TD);?></option> -->
									<option value="4"><?php _e('Icomoon',APMM_PRO_TD);?></option>
									<option value="5"><?php _e('Linecon',APMM_PRO_TD);?></option>
								</select>
								<div class="font-awesome-icon" id="fontawesome">
				                      <input type="text" class="search_icons" name="search" id="search_faicons" placeholder="<?php _e('Search Icon',APMM_PRO_TD);?>"/>
				                      <div class="clear"></div>
									  <?php 
										foreach($font_awesome_icons as $key){ ?>
										<div class="icon" id="icon-<?php echo $key;?>" title="<?php echo $key; ?>">
											<i class="fa fa-<?php echo $key; ?>"></i>
										</div>

									<?php } ?>

								</div>				

								<div class="genericon-icon" id="genericon">
				                    <input type="text" name="search" class="search_icons" id="search_gicons" placeholder="<?php _e('Search Icon',APMM_PRO_TD);?>"/>
				                    <div class="clear"></div>
									<?php 
										foreach($genericon_icon as $key){
									?>

										<div class="icon" id="icon-<?php echo $key;?>" title="<?php echo $key; ?>">
											<i class="genericon genericon-<?php echo $key; ?>"></i>
										</div>

									<?php } ?>

								</div>
							   <div class="dash-icon" id="dashicon">
				                    <input type="text" name="search" class="search_icons" id="search_dicons" placeholder="<?php _e('Search Icon',APMM_PRO_TD);?>"/>
				                    <div class="clear"></div>
									<?php 
										foreach($dashicons as $key){
									?>

										<div class="icon" id="icon-<?php echo $key;?>" title="<?php echo $key; ?>">
											<i class="dashicons dashicons-<?php echo $key; ?>"></i>
										</div>

									<?php } ?>

								</div>
								 <!--  <div class="flat-icon" id="flaticon">
				                    <input type="text" name="search" class="search_icons" id="search_ficons" placeholder="<?php _e('Search Icon',APMM_PRO_TD);?>"/>
				                    <div class="clear"></div>
									<?php 
										foreach($flaticons as $key){
									?>

										<div class="icon" id="icon-<?php echo $key;?>" title="<?php echo $key; ?>">
											<i class="<?php echo $key; ?>"></i>
										</div>

									<?php } ?>

								</div> -->
								<div class="ico-moon" id="iconmoon">
 <input type="text" name="search" class="search_icons" id="search_icomoonicons" placeholder="<?php _e('Search Icon',APMM_PRO_TD);?>"/>
								<div class="clear"></div>

			<div class="icon" title="home"><i class="icomoon-home"></i></div>
			<div class="icon" title="home2"><i class="icomoon-home2"></i></div>
			<div class="icon" title="home3"><i class="icomoon-home3"></i></div>
			<div class="icon" title="office"><i class="icomoon-office"></i></div>
			<div class="icon" title="newspaper"><i class="icomoon-newspaper"></i></div>
			<div class="icon" title="pencil"><i class="icomoon-pencil"></i></div>
			<div class="icon" title="pencil2"><i class="icomoon-pencil2"></i></div>
			<div class="icon" title="quill"><i class="icomoon-quill"></i></div>
			<div class="icon" title="pen"><i class="icomoon-pen"></i></div>
			<div class="icon" title="blog"><i class="icomoon-blog"></i></div>
			<div class="icon" title="eyedropper"><i class="icomoon-eyedropper"></i></div>
			<div class="icon" title="droplet"><i class="icomoon-droplet"></i></div>
			<div class="icon" title="paint-format"><i class="icomoon-paint-format"></i></div>
			<div class="icon" title="image"><i class="icomoon-image"></i></div>
			<div class="icon" title="images"><i class="icomoon-images"></i></div>
			<div class="icon" title="camera"><i class="icomoon-camera"></i></div>
			<div class="icon" title="headphones"><i class="icomoon-headphones"></i></div>
			<div class="icon" title="music"><i class="icomoon-music"></i></div>
			<div class="icon" title="play"><i class="icomoon-play"></i></div>
			<div class="icon" title="film"><i class="icomoon-film"></i></div>
			<div class="icon" title="video-camera"><i class="icomoon-video-camera"></i></div>
			<div class="icon" title="dice"><i class="icomoon-dice"></i></div>
			<div class="icon" title="pacman"><i class="icomoon-pacman"></i></div>
			<div class="icon" title="spades"><i class="icomoon-spades"></i></div>
			<div class="icon" title="clubs"><i class="icomoon-clubs"></i></div>
			<div class="icon" title="diamonds"><i class="icomoon-diamonds"></i></div>
			<div class="icon" title="bullhorn"><i class="icomoon-bullhorn"></i></div>
			<div class="icon" title="connection"><i class="icomoon-connection"></i></div>
			<div class="icon" title="podcast"><i class="icomoon-podcast"></i></div>
			<div class="icon" title="feed"><i class="icomoon-feed"></i></div>
			<div class="icon" title="mic"><i class="icomoon-mic"></i></div>
			<div class="icon" title="book"><i class="icomoon-book"></i></div>
			<div class="icon" title="books"><i class="icomoon-books"></i></div>
			<div class="icon" title="library"><i class="icomoon-library"></i></div>
			<div class="icon" title="file-text"><i class="icomoon-file-text"></i></div>
			<div class="icon" title="profile"><i class="icomoon-profile"></i></div>
			<div class="icon" title="file-empty"><i class="icomoon-file-empty"></i></div>
			<div class="icon" title="files-empty"><i class="icomoon-files-empty"></i></div>
			<div class="icon" title="file-text2"><i class="icomoon-file-text2"></i></div>
			<div class="icon" title="file-picture"><i class="icomoon-file-picture"></i></div>
			<div class="icon" title="file-music"><i class="icomoon-file-music"></i></div>
			<div class="icon" title="file-play"><i class="icomoon-file-play"></i></div>
			<div class="icon" title="file-video"><i class="icomoon-file-video"></i></div>
			<div class="icon" title="file-zip"><i class="icomoon-file-zip"></i></div>
			<div class="icon" title="copy"><i class="icomoon-copy"></i></div>
			<div class="icon" title="paste"><i class="icomoon-paste"></i></div>
			<div class="icon" title="stack"><i class="icomoon-stack"></i></div>
			<div class="icon" title="folder"><i class="icomoon-folder"></i></div>
			<div class="icon" title="folder-open"><i class="icomoon-folder-open"></i></div>
			<div class="icon" title="folder-plus"><i class="icomoon-folder-plus"></i></div>
			<div class="icon" title="folder-minus"><i class="icomoon-folder-minus"></i></div>
			<div class="icon" title="folder-download"><i class="icomoon-folder-download"></i></div>
			<div class="icon" title="folder-upload"><i class="icomoon-folder-upload"></i></div>
			<div class="icon" title="price-tag"><i class="icomoon-price-tag"></i></div>
			<div class="icon" title="price-tags"><i class="icomoon-price-tags"></i></div>
			<div class="icon" title="barcode"><i class="icomoon-barcode"></i></div>
			<div class="icon" title="qrcode"><i class="icomoon-qrcode"></i></div>
			<div class="icon" title="ticket"><i class="icomoon-ticket"></i></div>
			<div class="icon" title="cart"><i class="icomoon-cart"></i></div>
			<div class="icon" title="coin-dollar"><i class="icomoon-coin-dollar"></i></div>
			<div class="icon" title="coin-euro"><i class="icomoon-coin-euro"></i></div>
			<div class="icon" title="coin-pound"><i class="icomoon-coin-pound"></i></div>
			<div class="icon" title="coin-yen"><i class="icomoon-coin-yen"></i></div>
			<div class="icon" title="credit-card"><i class="icomoon-credit-card"></i></div>
			<div class="icon" title="calculator"><i class="icomoon-calculator"></i></div>
			<div class="icon" title="lifebuoy"><i class="icomoon-lifebuoy"></i></div>
			<div class="icon" title="phone"><i class="icomoon-phone"></i></div>
			<div class="icon" title="phone-hang-up"><i class="icomoon-phone-hang-up"></i></div>
			<div class="icon" title="address-book"><i class="icomoon-address-book"></i></div>
			<div class="icon" title="envelop"><i class="icomoon-envelop"></i></div>
			<div class="icon" title="pushpin"><i class="icomoon-pushpin"></i></div>
			<div class="icon" title="location"><i class="icomoon-location"></i></div>
			<div class="icon" title="location2"><i class="icomoon-location2"></i></div>
			<div class="icon" title="compass"><i class="icomoon-compass"></i></div>
			<div class="icon" title="compass2"><i class="icomoon-compass2"></i></div>
			<div class="icon" title="map"><i class="icomoon-map"></i></div>
			<div class="icon" title="map2"><i class="icomoon-map2"></i></div>
			<div class="icon" title="history"><i class="icomoon-history"></i></div>
			<div class="icon" title="clock"><i class="icomoon-clock"></i></div>
			<div class="icon" title="clock2"><i class="icomoon-clock2"></i></div>

			<div class="icon" title="alarm"><i class="icomoon-alarm"></i></div>
			<div class="icon" title="bell"><i class="icomoon-bell"></i></div>
			<div class="icon" title="stopwatch"><i class="icomoon-stopwatch"></i></div>
			<div class="icon" title="calendar"><i class="icomoon-calendar"></i></div>
			<div class="icon" title="printer"><i class="icomoon-printer"></i></div>
			<div class="icon" title="keyboard"><i class="icomoon-keyboard"></i></div>
			<div class="icon" title="display"><i class="icomoon-display"></i></div>

			<div class="icon" title="laptop"><i class="icomoon-laptop"></i></div>
			<div class="icon" title="mobile"><i class="icomoon-mobile"></i></div>
			<div class="icon" title="mobile2"><i class="icomoon-mobile2"></i></div>
			<div class="icon" title="tablet"><i class="icomoon-tablet"></i></div>
			<div class="icon" title="tv"><i class="icomoon-tv"></i></div>
			<div class="icon" title="drawer"><i class="icomoon-drawer"></i></div>
			<div class="icon" title="drawer2"><i class="icomoon-drawer2"></i></div>

			<div class="icon" title="box-add"><i class="icomoon-box-add"></i></div>
			<div class="icon" title="box-remove"><i class="icomoon-box-remove"></i></div>
			<div class="icon" title="download"><i class="icomoon-download"></i></div>
			<div class="icon" title="upload"><i class="icomoon-upload"></i></div>
			<div class="icon" title="home"><i class="icomoon-floppy-disk"></i></div>

			<div class="icon" title="drive"><i class="icomoon-drive"></i></div>
			<div class="icon" title="database"><i class="icomoon-database"></i></div>
			<div class="icon" title="undo"><i class="icomoon-undo"></i></div>
			<div class="icon" title="redo"><i class="icomoon-redo"></i></div>
			<div class="icon" title="undo2"><i class="icomoon-undo2"></i></div>
			<div class="icon" title="redo2"><i class="icomoon-redo2"></i></div>
			<div class="icon" title="forward"><i class="icomoon-forward"></i></div>
			<div class="icon" title="reply"><i class="icomoon-reply"></i></div>

			<div class="icon" title="bubble"><i class="icomoon-bubble"></i></div>
			<div class="icon" title="bubbles"><i class="icomoon-bubbles"></i></div>
			<div class="icon" title="bubbles2"><i class="icomoon-bubbles2"></i></div>
			<div class="icon" title="bubble2"><i class="icomoon-bubble2"></i></div>
			<div class="icon" title="bubbles3"><i class="icomoon-bubbles3"></i></div>
			<div class="icon" title="bubbles4"><i class="icomoon-bubbles4"></i></div>
			<div class="icon" title="user"><i class="icomoon-user"></i></div>
			<div class="icon" title="users"><i class="icomoon-users"></i></div>
			<div class="icon" title="user-plus"><i class="icomoon-user-plus"></i></div>
			<div class="icon" title="user-minus"><i class="icomoon-user-minus"></i></div>
			<div class="icon" title="user-check"><i class="icomoon-user-check"></i></div>
			<div class="icon" title="user-tie"><i class="icomoon-user-tie"></i></div>
			<div class="icon" title="quotes-left"><i class="icomoon-quotes-left"></i></div>
			<div class="icon" title="quotes-right"><i class="icomoon-quotes-right"></i></div>
			<div class="icon" title="hour-glass"><i class="icomoon-hour-glass"></i></div>
			<div class="icon" title="spinner"><i class="icomoon-spinner"></i></div>
			<div class="icon" title="spinner2"><i class="icomoon-spinner2"></i></div>
			<div class="icon" title="spinner3"><i class="icomoon-spinner3"></i></div>
			<div class="icon" title="spinner4"><i class="icomoon-spinner4"></i></div>
			<div class="icon" title="spinner5"><i class="icomoon-spinner5"></i></div>
			<div class="icon" title="spinner6"><i class="icomoon-spinner6"></i></div>
			<div class="icon" title="spinner7"><i class="icomoon-spinner7"></i></div>
			<div class="icon" title="spinner8"><i class="icomoon-spinner8"></i></div>
			<div class="icon" title="spinner9"><i class="icomoon-spinner9"></i></div>
			<div class="icon" title="spinner10"><i class="icomoon-spinner10"></i></div>
			<div class="icon" title="spinner11"><i class="icomoon-spinner11"></i></div>
			<div class="icon" title="binoculars"><i class="icomoon-binoculars"></i></div>
			<div class="icon" title="search"><i class="icomoon-search"></i></div>
			<div class="icon" title="zoom-in"><i class="icomoon-zoom-in"></i></div>
			<div class="icon" title="zoom-out"><i class="icomoon-zoom-out"></i></div>

			<div class="icon" title="enlarge"><i class="icomoon-enlarge"></i></div>
			<div class="icon" title="shrink"><i class="icomoon-shrink"></i></div>
			<div class="icon" title="enlarge2"><i class="icomoon-enlarge2"></i></div>
			<div class="icon" title="shrink2"><i class="icomoon-shrink2"></i></div>
			<div class="icon" title="key"><i class="icomoon-key"></i></div>
			<div class="icon" title="key2"><i class="icomoon-key2"></i></div>
			<div class="icon" title="lock"><i class="icomoon-lock"></i></div>
			<div class="icon" title="unlocked"><i class="icomoon-unlocked"></i></div>
			<div class="icon" title="wrench"><i class="icomoon-wrench"></i></div>
			<div class="icon" title="equalizer"><i class="icomoon-equalizer"></i></div>
			<div class="icon" title="equalizer2"><i class="icomoon-equalizer2"></i></div>
			<div class="icon" title="cog"><i class="icomoon-cog"></i></div>
			<div class="icon" title="cogs"><i class="icomoon-cogs"></i></div>
			<div class="icon" title="hammer"><i class="icomoon-hammer"></i></div>
			<div class="icon" title="magic-wand"><i class="icomoon-magic-wand"></i></div>
			<div class="icon" title="aid-kit"><i class="icomoon-aid-kit"></i></div>
			<div class="icon" title="bug"><i class="icomoon-bug"></i></div>
			<div class="icon" title="pie-chart"><i class="icomoon-pie-chart"></i></div>

			<div class="icon" title="dots"><i class="icomoon-stats-dots"></i></div>
			<div class="icon" title="bars"><i class="icomoon-stats-bars"></i></div>
			<div class="icon" title="bars2"><i class="icomoon-stats-bars2"></i></div>
			<div class="icon" title="trophy"><i class="icomoon-trophy"></i></div>
			<div class="icon" title="gift"><i class="icomoon-gift"></i></div>
			<div class="icon" title="glass"><i class="icomoon-glass"></i></div>
			<div class="icon" title="glass2"><i class="icomoon-glass2"></i></div>
			<div class="icon" title="mug"><i class="icomoon-mug"></i></div>
			<div class="icon" title="knife"><i class="icomoon-spoon-knife"></i></div>
			<div class="icon" title="leaf"><i class="icomoon-leaf"></i></div>
			<div class="icon" title="rocket"><i class="icomoon-rocket"></i></div>
			<div class="icon" title="meter"><i class="icomoon-meter"></i></div>
			<div class="icon" title="meter2"><i class="icomoon-meter2"></i></div>
			<div class="icon" title="hammer2"><i class="icomoon-hammer2"></i></div>
			<div class="icon" title="fire"><i class="icomoon-fire"></i></div>
			<div class="icon" title="lab"><i class="icomoon-lab"></i></div>
			<div class="icon" title="magnet"><i class="icomoon-magnet"></i></div>
			<div class="icon" title="bin"><i class="icomoon-bin"></i></div>
			<div class="icon" title="bin2"><i class="icomoon-bin2"></i></div>
			<div class="icon" title="briefcase"><i class="icomoon-briefcase"></i></div>
			<div class="icon" title="airplane"><i class="icomoon-airplane"></i></div>
			<div class="icon" title="truck"><i class="icomoon-truck"></i></div>
			<div class="icon" title="road"><i class="icomoon-road"></i></div>
			<div class="icon" title="accessibility"><i class="icomoon-accessibility"></i></div>
			<div class="icon" title="target"><i class="icomoon-target"></i></div>
			<div class="icon" title="shield"><i class="icomoon-shield"></i></div>
			<div class="icon" title="power"><i class="icomoon-power"></i></div>
			<div class="icon" title="switch"><i class="icomoon-switch"></i></div>
			<div class="icon" title="power-cord"><i class="icomoon-power-cord"></i></div>
			<div class="icon" title="clipboard"><i class="icomoon-clipboard"></i></div>
			<div class="icon" title="list-numbered"><i class="icomoon-list-numbered"></i></div>
			<div class="icon" title="list"><i class="icomoon-list"></i></div>
			<div class="icon" title="list2"><i class="icomoon-list2"></i></div>
			<div class="icon" title="tree"><i class="icomoon-tree"></i></div>
			<div class="icon" title="menu"><i class="icomoon-menu"></i></div>
			<div class="icon" title="menu2"><i class="icomoon-menu2"></i></div>
			<div class="icon" title="menu3"><i class="icomoon-menu3"></i></div>
			<div class="icon" title="menu4"><i class="icomoon-menu4"></i></div>

			<div class="icon" title="cloud"><i class="icomoon-cloud"></i></div>
			<div class="icon" title="download"><i class="icomoon-cloud-download"></i></div>
			<div class="icon" title="upload"><i class="icomoon-cloud-upload"></i></div>
			<div class="icon" title="check"><i class="icomoon-cloud-check"></i></div>
			<div class="icon" title="download2"><i class="icomoon-download2"></i></div>
			<div class="icon" title="upload2"><i class="icomoon-upload2"></i></div>
			<div class="icon" title="download3"><i class="icomoon-download3"></i></div>
			<div class="icon" title="upload3"><i class="icomoon-upload3"></i></div>
			<div class="icon" title="sphere"><i class="icomoon-sphere"></i></div>
			<div class="icon" title="earth"><i class="icomoon-earth"></i></div>
			<div class="icon" title="link"><i class="icomoon-link"></i></div>
			<div class="icon" title="flag"><i class="icomoon-flag"></i></div>
			<div class="icon" title="attachment"><i class="icomoon-attachment"></i></div>
			<div class="icon" title="eye"><i class="icomoon-eye"></i></div>
			<div class="icon" title="eyeplus"><i class="icomoon-eye-plus"></i></div>
			<div class="icon" title="eye-minus"><i class="icomoon-eye-minus"></i></div>
			<div class="icon" title="eye-blocked"><i class="icomoon-eye-blocked"></i></div>
			<div class="icon" title="bookmark"><i class="icomoon-bookmark"></i></div>
			<div class="icon" title="bookmarks"><i class="icomoon-bookmarks"></i></div>
			
			<div class="icon" title="sun"><i class="icomoon-sun"></i></div>
			<div class="icon" title="home"><i class="icomoon-contrast"></i></div>
			<div class="icon" title="home"><i class="icomoon-brightness-contrast"></i></div>
			<div class="icon" title="home"><i class="icomoon-star-empty"></i></div>
			<div class="icon" title="home"><i class="icomoon-star-half"></i></div>
			<div class="icon" title="home"><i class="icomoon-star-full"></i></div>
			<div class="icon" title="home"><i class="icomoon-heart"></i></div>
			<div class="icon" title="home"><i class="icomoon-heart-broken"></i></div>
			<div class="icon" title="home"><i class="icomoon-man"></i></div>
			<div class="icon" title="home"><i class="icomoon-woman"></i></div>
			<div class="icon" title="home"><i class="icomoon-man-woman"></i></div>
			<div class="icon" title="home"><i class="icomoon-happy"></i></div>
			<div class="icon" title="home"><i class="icomoon-happy2"></i></div>
			<div class="icon" title="home"><i class="icomoon-smile"></i></div>
			<div class="icon" title="home"><i class="icomoon-smile2"></i></div>
			<div class="icon" title="home"><i class="icomoon-tongue"></i></div>
			<div class="icon" title="home"><i class="icomoon-tongue2"></i></div>
			<div class="icon" title="home"><i class="icomoon-sad"></i></div>
			<div class="icon" title="home"><i class="icomoon-sad2"></i></div>
			<div class="icon" title="home"><i class="icomoon-wink"></i></div>
			<div class="icon" title="home"><i class="icomoon-wink2"></i></div>
			<div class="icon" title="home"><i class="icomoon-grin"></i></div>
			<div class="icon" title="home"><i class="icomoon-grin2"></i></div>
			<div class="icon" title="home"><i class="icomoon-cool"></i></div>
			<div class="icon" title="home"><i class="icomoon-cool2"></i></div>
			<div class="icon" title="home"><i class="icomoon-angry"></i></div>
			<div class="icon" title="home"><i class="icomoon-angry2"></i></div>
			<div class="icon" title="home"><i class="icomoon-evil"></i></div>
			<div class="icon" title="home"><i class="icomoon-evil2"></i></div>
			<div class="icon" title="home"><i class="icomoon-shocked"></i></div>
			<div class="icon" title="home"><i class="icomoon-shocked2"></i></div>
			<div class="icon" title="home"><i class="icomoon-baffled"></i></div>
			<div class="icon" title="home"><i class="icomoon-baffled2"></i></div>
			<div class="icon" title="home"><i class="icomoon-confused"></i></div>
			<div class="icon" title="home"><i class="icomoon-confused2"></i></div>
			<div class="icon" title="home"><i class="icomoon-neutral"></i></div>
			<div class="icon" title="home"><i class="icomoon-neutral2"></i></div>
			<div class="icon" title="home"><i class="icomoon-hipster"></i></div>
			<div class="icon" title="home"><i class="icomoon-hipster2"></i></div>
			<div class="icon" title="home"><i class="icomoon-wondering"></i></div>
			<div class="icon" title="home"><i class="icomoon-wondering2"></i></div>
			<div class="icon" title="home"><i class="icomoon-sleepy"></i></div>
			<div class="icon" title="home"><i class="icomoon-sleepy2"></i></div>
			<div class="icon" title="home"><i class="icomoon-frustrated"></i></div>
			<div class="icon" title="home"><i class="icomoon-frustrated2"></i></div>
			<div class="icon" title="home"><i class="icomoon-crying"></i></div>
			<div class="icon" title="home"><i class="icomoon-crying2"></i></div>
			<div class="icon" title="home"><i class="icomoon-point-up"></i></div>
			<div class="icon" title="home"><i class="icomoon-point-right"></i></div>
			<div class="icon" title="home"><i class="icomoon-point-down"></i></div>
			<div class="icon" title="home"><i class="icomoon-point-left"></i></div>
			<div class="icon" title="home"><i class="icomoon-warning"></i></div>
			<div class="icon" title="home"><i class="icomoon-notification"></i></div>
			<div class="icon" title="home"><i class="icomoon-question"></i></div>
			<div class="icon" title="home"><i class="icomoon-plus"></i></div>
			<div class="icon" title="home"><i class="icomoon-minus"></i></div>
			<div class="icon" title="home"><i class="icomoon-info"></i></div>
			<div class="icon" title="home"><i class="icomoon-cancel-circle"></i></div>
			<div class="icon" title="home"><i class="icomoon-blocked"></i></div>
			<div class="icon" title="home"><i class="icomoon-cross"></i></div>
			<div class="icon" title="home"><i class="icomoon-checkmark"></i></div>
			<div class="icon" title="home"><i class="icomoon-checkmark2"></i></div>
			<div class="icon" title="home"><i class="icomoon-spell-check"></i></div>
			<div class="icon" title="home"><i class="icomoon-enter"></i></div>
			<div class="icon" title="home"><i class="icomoon-exit"></i></div>
			<div class="icon" title="home"><i class="icomoon-play2"></i></div>
			<div class="icon" title="home"><i class="icomoon-pause"></i></div>
			<div class="icon" title="home"><i class="icomoon-stop"></i></div>
			<div class="icon" title="home"><i class="icomoon-previous"></i></div>
			<div class="icon" title="home"><i class="icomoon-next"></i></div>
			<div class="icon" title="home"><i class="icomoon-backward"></i></div>
			<div class="icon" title="home"><i class="icomoon-forward2"></i></div>
			<div class="icon" title="home"><i class="icomoon-play3"></i></div>
			<div class="icon" title="home"><i class="icomoon-pause2"></i></div>
			<div class="icon" title="home"><i class="icomoon-stop2"></i></div>
			<div class="icon" title="home"><i class="icomoon-backward2"></i></div>
			<div class="icon" title="home"><i class="icomoon-forward3"></i></div>
			<div class="icon" title="home"><i class="icomoon-first"></i></div>
			<div class="icon" title="home"><i class="icomoon-last"></i></div>
			<div class="icon" title="home"><i class="icomoon-previous2"></i></div>
			<div class="icon" title="home"><i class="icomoon-next2"></i></div>
			<div class="icon" title="home"><i class="icomoon-eject"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-high"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-medium"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-low"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-mute"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-mute2"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-increase"></i></div>
			<div class="icon" title="home"><i class="icomoon-volume-decrease"></i></div>
			<div class="icon" title="home"><i class="icomoon-loop"></i></div>
			<div class="icon" title="home"><i class="icomoon-loop2"></i></div>
			<div class="icon" title="home"><i class="icomoon-infinite"></i></div>
			<div class="icon" title="home"><i class="icomoon-shuffle"></i></div>
			<div class="icon" title="arrow-up-left"><i class="icomoon-arrow-up-left"></i></div>
			<div class="icon" title="arrow-up"><i class="icomoon-arrow-up"></i></div>
			<div class="icon" title="arrow-up-right"><i class="icomoon-arrow-up-right"></i></div>
			<div class="icon" title="arrow-right"><i class="icomoon-arrow-right"></i></div>
			<div class="icon" title="arrow-down-right"><i class="icomoon-arrow-down-right"></i></div>
			<div class="icon" title="arrow-down"><i class="icomoon-arrow-down"></i></div>

			<div class="icon" title="arrow-down-left"><i class="icomoon-arrow-down-left"></i></div>
			<div class="icon" title="arrow-left"><i class="icomoon-arrow-left"></i></div>
			<div class="icon" title="arrow-up-left"><i class="icomoon-arrow-up-left2"></i></div>

			<div class="icon" title="arrow-up2"><i class="icomoon-arrow-up2"></i></div>
			<div class="icon" title="arrow-up-right2"><i class="icomoon-arrow-up-right2"></i></div>
			<div class="icon" title="arrow-right2"><i class="icomoon-arrow-right2"></i></div>
			<div class="icon" title="arrow-down-right2"><i class="icomoon-arrow-down-right2"></i></div>
			<div class="icon" title="arrow-down2"><i class="icomoon-arrow-down2"></i></div>
			<div class="icon" title="arrow-down-left2"><i class="icomoon-arrow-down-left2"></i></div>
			<div class="icon" title="arrow-left2"><i class="icomoon-arrow-left2"></i></div>
			<div class="icon" title="circle-up"><i class="icomoon-circle-up"></i></div>
			<div class="icon" title="circle-right"><i class="icomoon-circle-right"></i></div>
			<div class="icon" title="circle-down"><i class="icomoon-circle-down"></i></div>
			<div class="icon" title="circle-left"><i class="icomoon-circle-left"></i></div>
			<div class="icon" title="tab"><i class="icomoon-tab"></i></div>
			<div class="icon" title="move-up"><i class="icomoon-move-up"></i></div>
			<div class="icon" title="move-down"><i class="icomoon-move-down"></i></div>
			<div class="icon" title="sort-alpha-asc"><i class="icomoon-sort-alpha-asc"></i></div>
			<div class="icon" title="sort-alpha-desc"><i class="icomoon-sort-alpha-desc"></i></div>
			<div class="icon" title="sort-numeric-asc"><i class="icomoon-sort-numeric-asc"></i></div>
			<div class="icon" title="sort-numberic-desc"><i class="icomoon-sort-numberic-desc"></i></div>
			<div class="icon" title="sort-amount-asc"><i class="icomoon-sort-amount-asc"></i></div>
			<div class="icon" title="sort-amount-desc"><i class="icomoon-sort-amount-desc"></i></div>
			<div class="icon" title="command"><i class="icomoon-command"></i></div>
			<div class="icon" title="shift"><i class="icomoon-shift"></i></div>
			<div class="icon" title="ctrl"><i class="icomoon-ctrl"></i></div>
			<div class="icon" title="opt"><i class="icomoon-opt"></i></div>
			<div class="icon" title="checked"><i class="icomoon-checkbox-checked"></i></div>
			<div class="icon" title="unchecked"><i class="icomoon-checkbox-unchecked"></i></div>
			<div class="icon" title="checked"><i class="icomoon-radio-checked"></i></div>
			<div class="icon" title="checked2"><i class="icomoon-radio-checked2"></i></div>
			<div class="icon" title="unchecked"><i class="icomoon-radio-unchecked"></i></div>
			<div class="icon" title="crop"><i class="icomoon-crop"></i></div>
			<div class="icon" title="make-group"><i class="icomoon-make-group"></i></div>
			<div class="icon" title="ungroup"><i class="icomoon-ungroup"></i></div>
			<div class="icon" title="scissors"><i class="icomoon-scissors"></i></div>
			<div class="icon" title="filter"><i class="icomoon-filter"></i></div>
			<div class="icon" title="font"><i class="icomoon-font"></i></div>
			<div class="icon" title="ligature"><i class="icomoon-ligature"></i></div>
			<div class="icon" title="ligature2"><i class="icomoon-ligature2"></i></div>
			<div class="icon" title="text-height"><i class="icomoon-text-height"></i></div>
			<div class="icon" title="text-width"><i class="icomoon-text-width"></i></div>
			<div class="icon" title="font-size"><i class="icomoon-font-size"></i></div>
			<div class="icon" title="bold"><i class="icomoon-bold"></i></div>
			<div class="icon" title="underline"><i class="icomoon-underline"></i></div>
			<div class="icon" title="italic"><i class="icomoon-italic"></i></div>
			<div class="icon" title="strikethrough"><i class="icomoon-strikethrough"></i></div>
			<div class="icon" title="omega"><i class="icomoon-omega"></i></div>
			<div class="icon" title="sigma"><i class="icomoon-sigma"></i></div>
			<div class="icon" title="page-break"><i class="icomoon-page-break"></i></div>
			<div class="icon" title="superscript"><i class="icomoon-superscript"></i></div>
			<div class="icon" title="subscript"><i class="icomoon-subscript"></i></div>
			<div class="icon" title="superscript2"><i class="icomoon-superscript2"></i></div>
			<div class="icon" title="subscript2"><i class="icomoon-subscript2"></i></div>
			<div class="icon" title="text-color"><i class="icomoon-text-color"></i></div>
			<div class="icon" title="pagebreak"><i class="icomoon-pagebreak"></i></div>
			<div class="icon" title="clear"><i class="icomoon-clear-formatting"></i></div>
			<div class="icon" title="table"><i class="icomoon-table"></i></div>
			<div class="icon" title="table2"><i class="icomoon-table2"></i></div>
			<div class="icon" title="insert-template"><i class="icomoon-insert-template"></i></div>
			<div class="icon" title="pilcrow"><i class="icomoon-pilcrow"></i></div>
			<div class="icon" title="ltr"><i class="icomoon-ltr"></i></div>
			<div class="icon" title="rtl"><i class="icomoon-rtl"></i></div>
			<div class="icon" title="section"><i class="icomoon-section"></i></div>
			<div class="icon" title="paragraph-left"><i class="icomoon-paragraph-left"></i></div>
			<div class="icon" title="paragraph-center"><i class="icomoon-paragraph-center"></i></div>
			<div class="icon" title="paragraph-right"><i class="icomoon-paragraph-right"></i></div>
			<div class="icon" title="paragraph-justify"><i class="icomoon-paragraph-justify"></i></div>
			<div class="icon" title="indent-increase"><i class="icomoon-indent-increase"></i></div>
			<div class="icon" title="indent-decrease"><i class="icomoon-indent-decrease"></i></div>
			<div class="icon" title="share"><i class="icomoon-share"></i></div>
			<div class="icon" title="new-tab"><i class="icomoon-new-tab"></i></div>
			<div class="icon" title="embed"><i class="icomoon-embed"></i></div>
			<div class="icon" title="embed2"><i class="icomoon-embed2"></i></div>
			<div class="icon" title="terminal"><i class="icomoon-terminal"></i></div>
			<div class="icon" title="share2"><i class="icomoon-share2"></i></div>
			<div class="icon" title="mail"><i class="icomoon-mail"></i></div>
			<div class="icon" title="mail2"><i class="icomoon-mail2"></i></div>
			<div class="icon" title="mail3"><i class="icomoon-mail3"></i></div>
			<div class="icon" title="mail4"><i class="icomoon-mail4"></i></div>
			<div class="icon" title="google"><i class="icomoon-google"></i></div>
			<div class="icon" title="google-plus"><i class="icomoon-google-plus"></i></div>
			<div class="icon" title="google-plus2"><i class="icomoon-google-plus2"></i></div>
			<div class="icon" title="google-plus3"><i class="icomoon-google-plus3"></i></div>
			<div class="icon" title="google-drive"><i class="icomoon-google-drive"></i></div>
			<div class="icon" title="facebook"><i class="icomoon-facebook"></i></div>
			<div class="icon" title="facebook2"><i class="icomoon-facebook2"></i></div>
			<div class="icon" title="facebook3"><i class="icomoon-facebook3"></i></div>
			<div class="icon" title="ello"><i class="icomoon-ello"></i></div>
			<div class="icon" title="instagram"><i class="icomoon-instagram"></i></div>
			<div class="icon" title="twitter"><i class="icomoon-twitter"></i></div>
			<div class="icon" title="twitter2"><i class="icomoon-twitter2"></i></div>
			<div class="icon" title="twitter3"><i class="icomoon-twitter3"></i></div>
			<div class="icon" title="feed2"><i class="icomoon-feed2"></i></div>
			<div class="icon" title="feed3"><i class="icomoon-feed3"></i></div>
			<div class="icon" title="feed4"><i class="icomoon-feed4"></i></div>
			<div class="icon" title="youtube"><i class="icomoon-youtube"></i></div>
			<div class="icon" title="youtube2"><i class="icomoon-youtube2"></i></div>
			<div class="icon" title="youtube3"><i class="icomoon-youtube3"></i></div>
			<div class="icon" title="youtube4"><i class="icomoon-youtube4"></i></div>
			<div class="icon" title="twitch"><i class="icomoon-twitch"></i></div>
			<div class="icon" title="vimeo"><i class="icomoon-vimeo"></i></div>
			<div class="icon" title="vimeo2"><i class="icomoon-vimeo2"></i></div>
			<div class="icon" title="vimeo3"><i class="icomoon-vimeo3"></i></div>
			<div class="icon" title="lanyrd"><i class="icomoon-lanyrd"></i></div>
			<div class="icon" title="flickr"><i class="icomoon-flickr"></i></div>
			<div class="icon" title="flickr2"><i class="icomoon-flickr2"></i></div>
			<div class="icon" title="flickr3"><i class="icomoon-flickr3"></i></div>
			<div class="icon" title="flickr4"><i class="icomoon-flickr4"></i></div>
			<div class="icon" title="picassa"><i class="icomoon-picassa"></i></div>
			<div class="icon" title="picassa2"><i class="icomoon-picassa2"></i></div>
			<div class="icon" title="dribbble"><i class="icomoon-dribbble"></i></div>
			<div class="icon" title="dribbble2"><i class="icomoon-dribbble2"></i></div>
			<div class="icon" title="dribbble3"><i class="icomoon-dribbble3"></i></div>
			<div class="icon" title="forrst"><i class="icomoon-forrst"></i></div>
			<div class="icon" title="forrst2"><i class="icomoon-forrst2"></i></div>
			<div class="icon" title="deviantart"><i class="icomoon-deviantart"></i></div>
			<div class="icon" title="deviantart2"><i class="icomoon-deviantart2"></i></div>
			<div class="icon" title="steam"><i class="icomoon-steam"></i></div>
			<div class="icon" title="steam2"><i class="icomoon-steam2"></i></div>
			<div class="icon" title="dropbox"><i class="icomoon-dropbox"></i></div>
			<div class="icon" title="onedrive"><i class="icomoon-onedrive"></i></div>
			<div class="icon" title="github"><i class="icomoon-github"></i></div>
			<div class="icon" title="github2"><i class="icomoon-github2"></i></div>
			<div class="icon" title="github3"><i class="icomoon-github3"></i></div>
			<div class="icon" title="github4"><i class="icomoon-github4"></i></div>
			<div class="icon" title="github5"><i class="icomoon-github5"></i></div>
			<div class="icon" title="wordpress"><i class="icomoon-wordpress"></i></div>
			<div class="icon" title="wordpress2"><i class="icomoon-wordpress2"></i></div>
			<div class="icon" title="joomla"><i class="icomoon-joomla"></i></div>
			<div class="icon" title="blogger"><i class="icomoon-blogger"></i></div>
			<div class="icon" title="blogger2"><i class="icomoon-blogger2"></i></div>
			<div class="icon" title="tumblr"><i class="icomoon-tumblr"></i></div>
			<div class="icon" title="tumblr2"><i class="icomoon-tumblr2"></i></div>
			<div class="icon" title="yahoo"><i class="icomoon-yahoo"></i></div>
			<div class="icon" title="tux"><i class="icomoon-tux"></i></div>
			<div class="icon" title="apple"><i class="icomoon-apple"></i></div>
			<div class="icon" title="finder"><i class="icomoon-finder"></i></div>
			<div class="icon" title="android"><i class="icomoon-android"></i></div>
			<div class="icon" title="windows"><i class="icomoon-windows"></i></div>
			<div class="icon" title="windows8"><i class="icomoon-windows8"></i></div>
			<div class="icon" title="soundcloud"><i class="icomoon-soundcloud"></i></div>
			<div class="icon" title="soundcloud2"><i class="icomoon-soundcloud2"></i></div>
			<div class="icon" title="skype"><i class="icomoon-skype"></i></div>
			<div class="icon" title="reddit"><i class="icomoon-reddit"></i></div>
			<div class="icon" title="linkedin"><i class="icomoon-linkedin"></i></div>
			<div class="icon" title="linkedin2"><i class="icomoon-linkedin2"></i></div>
			<div class="icon" title="lastfm"><i class="icomoon-lastfm"></i></div>
			<div class="icon" title="lastfm2"><i class="icomoon-lastfm2"></i></div>
			<div class="icon" title="delicious"><i class="icomoon-delicious"></i></div>
			<div class="icon" title="stumbleupon"><i class="icomoon-stumbleupon"></i></div>
			<div class="icon" title="stumbleupon2"><i class="icomoon-stumbleupon2"></i></div>
			<div class="icon" title="stackoverflow"><i class="icomoon-stackoverflow"></i></div>
			<div class="icon" title="pinterest"><i class="icomoon-pinterest"></i></div>
			<div class="icon" title="pinterest2"><i class="icomoon-pinterest2"></i></div>
			<div class="icon" title="xing"><i class="icomoon-xing"></i></div>
			<div class="icon" title="xing2"><i class="icomoon-xing2"></i></div>
			<div class="icon" title="flattr"><i class="icomoon-flattr"></i></div>
			<div class="icon" title="foursquare"><i class="icomoon-foursquare"></i></div>
			<div class="icon" title="paypal"><i class="icomoon-paypal"></i></div>
			<div class="icon" title="paypal2"><i class="icomoon-paypal2"></i></div>
			<div class="icon" title="paypal3"><i class="icomoon-paypal3"></i></div>
			<div class="icon" title="yelp"><i class="icomoon-yelp"></i></div>
			<div class="icon" title="pdf"><i class="icomoon-file-pdf"></i></div>
			<div class="icon" title="openoffice"><i class="icomoon-file-openoffice"></i></div>
			<div class="icon" title="file-word"><i class="icomoon-file-word"></i></div>
			<div class="icon" title="file-excel"><i class="icomoon-file-excel"></i></div>
			<div class="icon" title="libreoffice"><i class="icomoon-libreoffice"></i></div>
			<div class="icon" title="html5"><i class="icomoon-html5"></i></div>
			<div class="icon" title="html52"><i class="icomoon-html52"></i></div>
			<div class="icon" title="css3"><i class="icomoon-css3"></i></div>
			<div class="icon" title="git"><i class="icomoon-git"></i></div>
			<div class="icon" title="svg"><i class="icomoon-svg"></i></div>
			<div class="icon" title="codepen"><i class="icomoon-codepen"></i></div>
			<div class="icon" title="chrome"><i class="icomoon-chrome"></i></div>
			<div class="icon" title="firefox"><i class="icomoon-firefox"></i></div>
			<div class="icon" title="IE"><i class="icomoon-IE"></i></div>
			<div class="icon" title="opera"><i class="icomoon-opera"></i></div>
			<div class="icon" title="safari"><i class="icomoon-safari"></i></div>
			<div class="icon" title="IcoMoon"><i class="icomoon-IcoMoon"></i></div>

								</div>

	<div class="line-icon" id="lineicon">
 <input type="text" name="search" class="search_icons" id="search_lineicons" placeholder="<?php _e('Search Icon',APMM_PRO_TD);?>"/>
			<div class="clear"></div>

			<div class="icon" title="heart2"><i class="linecon-heart2"></i></div>
			<div class="icon" title="cloud2"><i class="linecon-cloud2"></i></div>
			<div class="icon" title="star"><i class="linecon-star"></i></div> 			
			<div class="icon" title="tv2"><i class="linecon-tv2"></i></div> 			
			<div class="icon" title="sound"><i class="linecon-sound"></i></div> 			
			<div class="icon" title="video"><i class="linecon-video"></i></div> 			
			<div class="icon" title="trash"><i class="linecon-trash"></i></div> 			
			<div class="icon" title="user2"><i class="linecon-user2"></i></div> 			
			<div class="icon" title="key3"><i class="linecon-key3"></i></div> 			
			<div class="icon" title="search2"><i class="linecon-search2"></i></div> 			
			<div class="icon" title="settings"><i class="linecon-settings"></i></div> 			
			<div class="icon" title="camera2"><i class="linecon-camera2"></i></div> 			
			<div class="icon" title="tag"><i class="linecon-tag"></i></div> 			
			<div class="icon" title="lock2"><i class="linecon-lock2"></i></div> 			
			<div class="icon" title="bulb"><i class="linecon-bulb"></i></div> 			
			<div class="icon" title="pen2"><i class="linecon-pen2"></i></div> 			
			<div class="icon" title="diamond"><i class="linecon-diamond"></i></div> 			
			<div class="icon" title="display2"><i class="linecon-display2"></i></div> 			
			<div class="icon" title="location3"><i class="linecon-location3"></i></div> 			
			<div class="icon" title="eye2"><i class="linecon-eye2"></i></div> 			
			<div class="icon" title="bubble3"><i class="linecon-bubble3"></i></div> 			
			<div class="icon" title="stack2"><i class="linecon-stack2"></i></div> 			
			<div class="icon" title="cup"><i class="linecon-cup"></i></div> 			
			<div class="icon" title="phone2"><i class="linecon-phone2"></i></div> 			
			<div class="icon" title="news"><i class="linecon-news"></i></div> 			
			<div class="icon" title="mail5"><i class="linecon-mail5"></i></div> 			
			<div class="icon" title="like"><i class="linecon-like"></i></div> 			
			<div class="icon" title="photo"><i class="linecon-photo"></i></div> 			
			<div class="icon" title="note"><i class="linecon-note"></i></div> 			
			<div class="icon" title="clock3"><i class="linecon-clock3"></i></div> 			
			<div class="icon" title="paperplane"><i class="linecon-paperplane"></i></div> 			
			<div class="icon" title="params"><i class="linecon-params"></i></div> 			
			<div class="icon" title="banknote"><i class="linecon-banknote"></i></div> 			
			<div class="icon" title="data"><i class="linecon-data"></i></div> 			
			<div class="icon" title="music2"><i class="linecon-music2"></i></div> 			
			<div class="icon" title="megaphone"><i class="linecon-megaphone"></i></div> 			
			<div class="icon" title="study"><i class="linecon-study"></i></div> 			
			<div class="icon" title="lab2"><i class="linecon-lab2"></i></div> 			
			<div class="icon" title="food"><i class="linecon-food"></i></div> 			
			<div class="icon" title="t-shirt"><i class="linecon-t-shirt"></i></div> 			
			<div class="icon" title="fire2"><i class="linecon-fire2"></i></div> 			
			<div class="icon" title="clip"><i class="linecon-clip"></i></div> 			
			<div class="icon" title="shop"><i class="linecon-shop"></i></div> 			
			<div class="icon" title="calendar2"><i class="linecon-calendar2"></i></div> 			
			<div class="icon" title="wallet"><i class="linecon-wallet"></i></div> 			
			<div class="icon" title="vynil"><i class="linecon-vynil"></i></div> 			
			<div class="icon" title="truck2"><i class="linecon-truck2"></i></div> 			
			<div class="icon" title="world"><i class="linecon-world"></i></div>

								</div>
				

							</div>
			
	                   </div>
				  </td>
			</tr>
</table>
  </div>

 <?php #if($menu_item_depth <= 0){ ?>
 <div class="settings_title"><h4><?php _e('Custom Icon Settings',APMM_PRO_TD);?></h4></div>
   <div class="wpmm_mega_settings">
   <div class="clear"></div>
<table class="widefat">
			 <tr>
				 <td class="wpmm_meta_table" style="width: 119px;"><label for="enable_customimg"><?php _e("Enable Custom Icon", APMM_PRO_TD) ?></label></td>
				  <td> 
                       <div class="wpmm-switch">
			          <input type='checkbox' class='wpmm_menu_settingss' id="enable_customimg" name='wpmm_settings[icons_settings][enable_customimg]' value='true' <?php echo checked($wpmmenu_item_meta['icons_settings']['enable_customimg'],'true', false ); ?>/>
			          <label for="enable_customimg"></label>
                    </div>
                       <p class="description"><?php _e("Note: Enable to show uploaded custom icon for menu. If this option is enable, only uploaded custom icon will be shown on this menu item, the above available icon will not be displayed.So, if you want to display above available choosed menu icon, then please do disable this option.", APMM_PRO_TD); ?></p>
				  </td>
		    </tr>

			 
			   <tr class="toggle_custom_image" id="customimage">
										<td class="wpmm_meta_table"><label><?php _e("Choose Icon", APMM_PRO_TD) ?></label></td>
										  <td> 
										  <div class="wpmm-option-field">
										   <input type="hidden" class="wpmm-customimage-url" name="wpmm_settings[icons_settings][custom_image_url]" 
										    value="<?php echo (isset( $wpmmenu_item_meta['icons_settings']['custom_image_url']) && $wpmmenu_item_meta['icons_settings']['custom_image_url'] != '')?esc_url($wpmmenu_item_meta['icons_settings']['custom_image_url']):'';?>" />
										    
										    <input type="button" class="wpmm_logo_url_button button button-primary button-large" 
										    id="customimage" name="wpmm_custom_image_url"  
										     value="Upload Custom Icon" size="25"/> 
										    <?php 
          									$img_url =(isset( $wpmmenu_item_meta['icons_settings']['custom_image_url']) && $wpmmenu_item_meta['icons_settings']['custom_image_url'] != '')?esc_url($wpmmenu_item_meta['icons_settings']['custom_image_url']):'';
          									if($img_url == ''){
          										$style = 'style="display:none;"';
          									}else{
                                                $style = '';
          									}
										    ?>
										     <div class="wpmm-option-field wpmm-image-preview3" <?php echo $style;?>>
							                         <a class="remove_custom_image_url" href="#">
													<i class="dashicons dashicons-trash"></i>
													</a>
							                      <img class="wpmm-custom-image" style="width: 80%;"
							                      src="<?php echo (isset( $wpmmenu_item_meta['icons_settings']['custom_image_url']) && $wpmmenu_item_meta['icons_settings']['custom_image_url'] != '')?esc_url($wpmmenu_item_meta['icons_settings']['custom_image_url']):'';?>" 
							                      alt="">
							                  </div>

										 </div>
										 </td>
				</tr>

				<tr>
											<td><label><?php _e("Custom Width/Height", APMM_PRO_TD) ?></label></td>
											<td>
										 	 <input type="number" placeholder="E.g., 40" class="wpmm-custom-width custom-cart-icon-size" name="wpmm_settings[icons_settings][custom_width]" 
										    value="<?php echo (isset( $wpmmenu_item_meta['icons_settings']['custom_width']) && $wpmmenu_item_meta['icons_settings']['custom_width'] != '')?esc_attr($wpmmenu_item_meta['icons_settings']['custom_width']):'';?>" />
										    <label><?php _e("Width(px)", APMM_PRO_TD) ?></label>
										    <input type="number" placeholder="E.g., 40" class="wpmm-custom-height custom-cart-icon-size" name="wpmm_settings[icons_settings][custom_height]" 
										    value="<?php echo (isset( $wpmmenu_item_meta['icons_settings']['custom_height']) && $wpmmenu_item_meta['icons_settings']['custom_height'] != '')?esc_attr($wpmmenu_item_meta['icons_settings']['custom_height']):'';?>" />
										     <label><?php _e("Height(px)", APMM_PRO_TD) ?></label>
										     <p class="description"><?php _e('Define image custom width/height in px.',APMM_PRO_TD);?></p>
										   </td>
					</tr>
       </table>
  </div>
  <?php #} ?>
<link rel='stylesheet' id='wpmm-icon-picker-genericons' href="<?php echo APMM_PRO_CSS_DIR.'/wpmm-icons/genericons.css';?>"/>
<link rel='stylesheet' id='wpmm-icon-picker-font-awesome' href="<?php echo APMM_PRO_CSS_DIR.'/wpmm-icons/font-awesome/font-awesome.css';?>"/>
<!-- <link rel='stylesheet' id='wpmm-flaticons' href="<?php echo APMM_PRO_CSS_DIR.'/wpmm-icons/flaticons/flaticon.css';?>"/> -->
<link rel='stylesheet' id='wpmm-icomoon' href="<?php echo APMM_PRO_CSS_DIR.'/wpmm-icons/icomoon/icomoon.min.css';?>"/>
<link rel='stylesheet' id='wpmm-linecon' href="<?php echo APMM_PRO_CSS_DIR.'/wpmm-icons/linecon/linecon.min.css';?>"/>