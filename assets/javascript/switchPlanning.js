var tabPlanningCrit1 = {'sport':true, 'animation':true};
var tabPlanningCrit2 = {'horaire-depasse':false, 'horaire-avenir':true};

function switchPlanning1(element) {
	if (tabPlanningCrit1[element]) // Actuellement affiché
	{
		$('.'+element).hide();
		tabPlanningCrit1[element] = false;
	}
	else
	{
		$('.'+element).each(function() {
			if (($(this).hasClass('horaire-depasse') && tabPlanningCrit2['horaire-depasse'])
				||
				($(this).hasClass('horaire-avenir') && tabPlanningCrit2['horaire-avenir']))
			$(this).show();
		});
		tabPlanningCrit1[element] = true;
	}
}

function switchPlanning2(element) {
	if (tabPlanningCrit2[element]) // Actuellement affiché
	{
		$('.'+element).hide();
		tabPlanningCrit2[element] = false;
	}
	else
	{
		$('.'+element).each(function() {
			if (($(this).hasClass('sport') && tabPlanningCrit1['sport'])
				||
				($(this).hasClass('animation') && tabPlanningCrit1['animation']))
			$(this).show();
		});
		tabPlanningCrit2[element] = true;
	}
}
