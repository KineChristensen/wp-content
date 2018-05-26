@media (max-width: <?php echo $custom_responsive_bp;?>px) {
	.wpmega-black-white .wpmega-openblock {
    color: white;
}
.wpmm-orientation-horizontal .wpmm-sub-menu-wrap .wpmm-single-bgimage, 
.wpmm-orientation-vertical .wpmm-sub-menu-wrap .wpmm-single-bgimage {
		display: none;
}

.wpmm-orientation-vertical .menutoggle,
	.wpmm-orientation-horizontal .menutoggle {
		display: none !important;
	}
	.wpmm-orientation-horizontal .wpmegamenu-toggle {
		display: block;
	}
	.wpmm-orientation-horizontal .wpmegamenu-toggle .wp-mega-toggle-block .dashicons {
		font-size: 26px;
	}
	.wpmm-orientation-horizontal .wpmegamenu-toggle .menutoggle {
		display: none;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li {
		width: 100%;
		border-bottom: 1px solid #ccc;
		text-align: left;
		position: relative;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper li:last-child {
		border-bottom: none;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper li .dropdown-toggle {
		display: none;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a,
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a.wpmega-searchdown, 
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a.wpmega-searchinline {
		padding: 15px 10px;
	}
	.wpmm_megamenu .wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a.wpmega-searchinline,
	.wpmm_megamenu .wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a.wpmm-csingle-menu {
		padding: 15px 10px;
	}
	.wp-megamenu-main-wrapper.wpmega-midnightblue-sky-white.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a::before {
		display: none;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li.menu-item-has-children a {
		margin-right: 0;
	}
	.wpmm-ctheme-wrapper.wpmm-orientation-horizontal .wpmegamenu-toggle .wpmega-openblock,
	.wpmm-ctheme-wrapper.wpmm-orientation-horizontal .wpmegamenu-toggle .wpmega-closeblock {
		padding: 10px 10px 13px;
		color: #000;
	}

	.wpmm-orientation-horizontal .wpmegamenu-toggle .wpmega-openblock,
	.wpmm-orientation-horizontal .wpmegamenu-toggle .wpmega-closeblock {
		padding: 10px 10px 13px;
		color: #fff;
	}
    .wpmm-orientation-horizontal.wpmega-clean-white .wpmegamenu-toggle .wpmega-openblock,
	.wpmm-orientation-horizontal.wpmega-clean-white .wpmegamenu-toggle .wpmega-closeblock {
		color: #000;
	}
	.wpmm-orientation-horizontal.wpmega-clean-white .wpmegamenu-toggle{
	    border: 1px solid #ccc;
     }

	.wpmm-orientation-vertical.wpmega-clean-white .wpmegamenu-toggle .wpmega-openblock,
	.wpmm-orientation-vertical.wpmega-clean-white .wpmegamenu-toggle .wpmega-closeblock{
      color: #000;
	}

	.wp-megamenu-main-wrapper .wpmm-mega-menu-label {
		top: 50%;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		left: 23%;
	}	 
	.wp-megamenu-main-wrapper .wpmm-mega-menu-label::before {
		border-color: #d500fb transparent transparent;
		border-style: solid;
		border-width: 7px 4.5px 0;
		bottom: -6px;
		content: "";
		height: 0;
		left: -6px;
		margin-left: auto;
		margin-right: auto;
		position: absolute;
		right: auto;
		top: 50%;
		transform: rotate(90deg) translateX(-50%);
		width: 0;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap {
		transition: none;
		-webkit-transition: none;
		-ms-transition: none;
	}
	.wpmm-orientation-horizontal .wpmega-responsive-closebtn {
		color: #fff;
		border-top: 1px solid #fff;
		padding: 15px 10px;
		font-weight: 600;
		position: relative;
		padding-left: 30px;
		cursor: pointer;
		z-index: 999999;
		overflow: hidden;
		clear: both;
	}
	.wpmm-orientation-horizontal .wpmega-responsive-closebtn:before {
		position: absolute;
		content: '\f00d';
		font-family: FontAwesome;
		font-size: 16px;
		left: 10px;
		line-height: 1.4;
	}
	/*.wpmm-orientation-horizontal ul li ul li.wp-mega-menu-header {
		width: 33.33%;
	}*/
	ul.wpmm-mega-wrapper li.wpmm-menu-align-right.wpmm-search-type:hover .wpmm-sub-menu-wrap {
		top: 0;
	}
	ul.wpmm-mega-wrapper li .wpmm-search-form .wpmm-search-icon.inline-toggle-right.inline-search.searchbox-open {
		left: auto;
		opacity: 1;
		right: 10px;
	}
	ul.wpmm-mega-wrapper li.wpmega-menu-flyout ul {
		width: 100%;
	}
	ul.wpmm-mega-wrapper li.wpmega-menu-flyout div,
	ul.wpmm-mega-wrapper li.wpmega-menu-flyout div ul li div {
		width: 100%;
		position: relative;
		max-height: 0;
	}
	ul.wpmm-mega-wrapper li.wpmega-menu-flyout.active-show > div {
		max-height: 1000px;
	}
	ul.wpmm-mega-wrapper li.wpmega-menu-flyout.active-show > div ul li.active-show > div {
    	max-height: 1000px;		
    } 
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout li.menu-item-has-children > a::after {
    	top: 12px;
    }
    .wpmm_megamenu .wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper > li > a.wpmega-searchdown {
    	padding: 15px 10px;
    }
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap {
    	position: relative;
    	max-height: 0;
    	transition: all ease 0.1s;
    	-webkit-transition: all ease 0.1s;
    	-ms-transition: all ease 0.1s;
    	padding: 0 8px 0;
    }
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper li.active-show .wpmm-sub-menu-wrap {
    	position: relative;
    	max-height: 10000px;
    	transition: all ease 0.3s;
    	-webkit-transition: all ease 0.3s;
    	-ms-transition: all ease 0.3s;
    	padding: 15px 8px 5px;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-right ul.wp-mega-sub-menu li.wpmm-submenu-align-left.menu-item-has-children a:after,
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-left ul.wp-mega-sub-menu li.wpmm-submenu-align-left.menu-item-has-children a:after {
    	left: auto;
    	right: 10px;
    	transform: rotate(180deg) !important;
	    -webkit-transform: rotate(180deg) !important;
	    -ms-transform: rotate(180deg) !important;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-right ul.wp-mega-sub-menu li.wpmm-submenu-align-left.menu-item-has-children a.wp-mega-menu-link {
    	padding-left: 10px;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout ul.wp-mega-sub-menu li a {
    	padding-left: 20px !important;
    }
    /*ul.wpmm-mega-wrapper li.wpmega-menu-flyout div {
		position: relative !important;
		left: 0 !important;
		right: 0 !important;
    }*/
    .wp-megamenu-main-wrapper.wpmm-onclick ul.wpmm-mega-wrapper li.wpmega-menu-flyout > div {
    	overflow: hidden;
    	height: 0;
    }
    .wp-megamenu-main-wrapper.wpmm-onclick ul.wpmm-mega-wrapper li.wpmega-menu-flyout > div.wpmm-open-fade {
    	height: 100%;
    	z-index: 999;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-left div ul li div {
    	right: 0;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout div {
    	z-index: 999;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-left div ul li.wpmm-submenu-align-right div {
    	left: 0;
    }
    .wpmm_megamenu ul.wpmm-mega-wrapper li.wpmega-hide-on-mobile {
		display: none;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical {
		width: 100%;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical .wp-mega-toggle-block {
		color: #fff;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical .wp-mega-toggle-block .wpmega-openblock,
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical .wp-mega-toggle-block .wpmega-closeblock {
		padding: 10px 10px 13px; 
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical .wp-mega-toggle-block .dashicons {
		font-size: 26px;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical .wp-mega-toggle-block .menutoggle {
		display: none;
	}
	.wpmm-orientation-vertical .wpmega-responsive-closebtn {
	    color: #fff;
	    border-top: 1px solid #fff;
	    padding: 10px;
	    font-weight: 600;
	    position: relative;
	    padding-left: 10px;
	    cursor: pointer;
	    z-index: 999999;
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical ul li.menu-item-has-children > a:after {
		content: '\f107';
	}
	.wp-megamenu-main-wrapper.wpmm-orientation-vertical ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap {
    	<!-- position: relative; -->
    	max-height: 0;
    	transition: all ease 0.1s;
    	-webkit-transition: all ease 0.1s;
    	-ms-transition: all ease 0.1s;
    	padding: 0 8px 0;
    	left: 0;
    	width: 100% !important;
    	right: 0;
    }
    .wp-megamenu-main-wrapper.wpmm-orientation-vertical ul.wpmm-mega-wrapper li.active-show .wpmm-sub-menu-wrap {
    	position: relative;
    	max-height: 10000px;
    	transition: all ease 0.3s;
    	-webkit-transition: all ease 0.3s;
    	-ms-transition: all ease 0.3s;
    	padding: 15px 8px 5px;
    }
    .wpmm-orientation-vertical ul.wpmm-mega-wrapper li.wpmega-menu-flyout div {
    	left: 0;
    }
    ul.wpmm-mega-wrapper li .wpmm-search-form .wpmm-search-icon.inline-toggle-left.inline-search.searchbox-open {
    	left: 40px;
    	top: 27px;
    }
     ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap ul.wp-mega-sub-menu li.wpmega-vertical-tabs ul.wpmm-tab-groups > li.wpmm-tabs-section > div.wpmm-sub-menu-wrapper > ul.wpmm-tab-groups-panel > li {
        width: 49%;
        padding: 0;
        margin: 0 0 10px;
    }
    ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap ul.wp-mega-sub-menu li.wpmega-vertical-tabs ul.wpmm-tab-groups > li.wpmm-tabs-section > div.wpmm-sub-menu-wrapper > ul.wpmm-tab-groups-panel > li:nth-child(even) {
        margin-left: 1%;
    }
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal ul.wpmm-mega-wrapper {
    	overflow: hidden;
    }
     ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-right div ul li.wpmm-submenu-align-left div{
        right:0;
    }
    ul.wpmm-mega-wrapper li.wpmega-menu-flyout.wpmega-flyout-horizontal-right div ul li div{
        left:0;
    }
    /*=============
    slide on click for responsive
    ==============*/
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal.wpmm-slide ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap, 
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal.wpmm-slide ul.wpmm-mega-wrapper li.wpmega-horizontal-left-edge .wpmm-sub-menu-wrap,
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal.wpmm-slide ul.wpmm-mega-wrapper li.wpmega-horizontal-center .wpmm-sub-menu-wrap {
    	left: 0;
    }
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal.wpmm-slide ul.wpmm-mega-wrapper li .wpmm-sub-menu-wrap {
    	position: static;
    	padding: 0 8px;
    }    
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal.wpmm-slide ul.wpmm-mega-wrapper li:hover .wpmm-sub-menu-wrap {
		opacity: 0;
		visibility: hidden;
		max-height: 0;
		padding: 0 8px;
    }
    .wp-megamenu-main-wrapper.wpmm-orientation-horizontal.wpmm-slide.wpmm-onclick ul.wpmm-mega-wrapper li.active-show .wpmm-sub-menu-wrap {
		opacity: 1;
		visibility: visible;
		max-height: 10000px;
		z-index: 999;
		transition: all 0.4s ease-in;
		-webkit-transition: all 0.4s ease-in;
		-ms-transition: all 0.4s ease-in;
		padding: 15px 8px 5px;
    }
    .wp-megamenu-main-wrapper.wpmm-onclick ul.wpmm-mega-wrapper li.wpmega-menu-flyout.active-show > div {
    	overflow: visible;
    }
 }