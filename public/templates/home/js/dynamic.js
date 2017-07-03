//回到顶部开始
var scrolltop = document.getElementById('scrolltop');
var clientHeight = document.documentElement.clientHeight;//获取可视页面的高度
var times = null;
//页面滚动时
window.onscroll = function()
{
	//获取滚动条的高度
	var osTop = document.documentElement.scrollTop || document.body.scrollTop;
	if(osTop >= clientHeight)
	{
		scrolltop.style.display = 'block';
	}
	else
	{
		scrolltop.style.display = 'none';
	}

}
scrolltop.onclick = function()
{

	times = setInterval(function()
	{
		//获取滚动条离顶部的高度
		var osTop = document.documentElement.scrollTop || document.body.scrollTop;
		var ispeed = Math.ceil(osTop / 7);
		document.documentElement.scrollTop = document.body.scrollTop -= ispeed;
		if(osTop == 0){
			clearInterval(times);
		}
		console.log(document.documentElement.scrollTop);
	},30);
}

//回到顶部结束



