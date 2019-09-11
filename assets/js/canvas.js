(function($)
{
	$('input.round').wrap('<div class="round" />').each(function()
	{
		var $input = $(this);
		var $div = $input.parent();
		var min = $input.data('min');
		var max = $input.data('max');
		var size = $input.data('size');
		var ratio = size / max;
		var color = $input.data('color');

		var $circle = $('<canvas width="200px" height="200px"/>');
		var $color = $('<canvas width="200px" height="200px"/>');
		$div.append($circle);
		$div.append($color);
		var ctx = $circle[0].getContext('2d');

		ctx.beginPath();
		ctx.arc(100,100,85,0,2*Math.PI);
		ctx.lineWidth = 20;
		ctx.strokeStyle = "#f7f7f7"
		ctx.shadowOffsetX = 2;
		ctx.shadowBlur = 5;
		ctx.shadowColor="rgba(0,0,0,0.2)";
		ctx.stroke();

		var ctx = $color[0].getContext('2d');
		ctx.beginPath();
		ctx.arc(100,100,85,-1/2 * Math.PI, ratio*2*Math.PI - 1/2 * Math.PI );
		ctx.lineWidth = 20;
		ctx.strokeStyle = color;
		ctx.stroke();
	})
})(jQuery);