<?php
/**
 * Component: Reading Progress Bar
 *
 * @package Loomy
 */

?>

<div 
	x-data="{ 
		percent: 0,
		updateProgress() {
			const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
			const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
			this.percent = (winScroll / height) * 100;
		}
	}" 
	x-init="window.addEventListener('scroll', () => updateProgress())"
	class="fixed top-0 left-0 w-full h-1 z-[60] pointer-events-none"
	role="progressbar"
	aria-valuemin="0"
	aria-valuemax="100"
	:aria-valuenow="Math.round(percent)"
>
	<div 
		class="h-full bg-blue-600 transition-all duration-150 ease-out"
		:style="`width: ${percent}%`"
	></div>
</div>
