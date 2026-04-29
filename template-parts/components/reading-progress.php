<?php
/**
 * Reading Progress Bar Template Part
 *
 * @package Loomy
 */
?>

<div 
	id="reading-progress-container"
	class="fixed top-0 left-0 w-full h-1 z-[120] pointer-events-none"
	role="progressbar"
	aria-valuemin="0"
	aria-valuemax="100"
	aria-valuenow="0"
>
	<div 
		id="reading-progress-bar"
		class="h-full bg-primary transition-all duration-150 ease-out" 
		style="width: 0%"
	></div>
</div>
