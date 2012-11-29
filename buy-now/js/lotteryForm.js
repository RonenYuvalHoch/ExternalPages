/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
 
jQuery.expr[':'].hasText = function(element, index) {
	// if there is only one child, and it is a text node
	if (element.childNodes.length == 1 && element.firstChild.nodeType == 3) {
		return jQuery.trim(element.innerHTML).length > 0;
	}
	return false;
};

jQuery(document).ready(function(){

	var max_regular_nums = parseInt(Drupal.settings.lottery['lotteryRowCheckNumPerLine']);
	var max_power_nums = parseInt(Drupal.settings.lottery['lotteryRowPowerCheckNumPerLine']);
	var max_row_nums = max_regular_nums + max_power_nums;
	var max_input_rows = parseInt(Drupal.settings.lottery['lotteryRowNumLines']);
	var row_price = parseFloat(Drupal.settings.lottery['lotteryRowPrice']);
	var row_subscription_price = parseFloat(Drupal.settings.lottery['lotteryRowSubscriptionPrice']);
	var lottery_id = parseInt(Drupal.settings.lottery['lotteryId']);
  var min_rows = parseInt(Drupal.settings.lottery['lotteryMinRows']);
	 
	var last_click = 'regular';
        
	//Set default active row.
	jQuery("#send-form .ticket_rows input").val('');
	jQuery("#send-form .ticket_rows #row_0 input.num").addClass('active');
	jQuery("#send-form .ticket_rows #row_0").addClass('active');
	jQuery(".lottery .ticket .lucky-numbers .numbers-container").addClass('active');
    
	//set ticket header
	var row_num = jQuery("#send-form .ticket_rows .row.active").index();
	var next_row_num,prev_row_num;
	jQuery(".ticket-header #row_num").text(digitToChar(row_num));
	if(row_num + 1 >= max_input_rows){
		next_row_num = 0;
	}
	else{
		next_row_num = row_num + 1;
	}
	if(row_num - 1 < 0){
		prev_row_num = max_input_rows - 1;
	}
	else{
		prev_row_num = row_num - 1;
	}
	jQuery(".ticket-header #prev_row_num").text(digitToChar(prev_row_num));
	jQuery(".ticket-header #next_row_num").text(digitToChar(next_row_num));
 
	// choose a numbers
	jQuery(".node-lottery-draw .lottery_number_list .lottery_number").click(function(){
		var activeRow = jQuery("#send-form .ticket_rows .row.active");
		var active_input;
		if(jQuery(this).hasClass('regular')){
			//set active input for regular
			active_input = setActiveInput(activeRow,'num');

			if (numOfChosenNumbersInCurrentInput(active_input.val()) < max_regular_nums || active_input.val().length === 0) {// row is not full
				//Selecting number.
				addOrRemoveChosen(jQuery(this));
			
				//Writing selected numbers into input.
				addInputValues('regular');
			}
			else{ // edit full row
				if(isInputContainsValue(jQuery(this).text())){
					addOrRemoveChosen(jQuery(this));
					addInputValues('regular');
				}
			}

			if (numOfChosenNumbersInCurrentInput(jQuery("#send-form .ticket_rows .row.active input.num").val()) >= max_regular_nums) {// regular nums are complete in current row
				switchForm();
				if(last_click == 'power'){
					last_click = 'regular';
				}
			}
			else if(last_click == 'power'){
				switchForm();
				last_click = 'regular';
			}
		}
		else{
		
			var that;
			that = this;
		
			//set active input for power
			active_input = setActiveInput(activeRow,'power_num');
            
			if (numOfChosenNumbersInCurrentInput(active_input.val()) < max_power_nums || active_input.val().length === 0) {// row is not full
				//Selecting number.
				addOrRemoveChosen(jQuery(this));
			
				//Writing selected numbers into input.
				addInputValues('power');
			}
			else{ // edit full row
				if(isInputContainsValue(jQuery(this).text())){
					addOrRemoveChosen(jQuery(this));
					addInputValues('power');
				}
			}
            
			if (numOfChosenNumbersInCurrentInput(jQuery("#send-form .ticket_rows .row.active input.power_num").val()) >= max_power_nums) {// power nums are complete in current row
				switchForm();
				if(last_click == 'regular'){
					last_click = 'power';
				}
			}
			else if(last_click == 'regular'){
				switchForm();
				last_click = 'power';
			}

			//Special condition for power ball per ticket.
			var currentNumber = this.innerHTML;
			if (Drupal.settings.lottery.lotteryPowerNumMarkedPer == "2") {
				
				jQuery('.ticket_rows div').each(function(){
					if (jQuery('.block-numbers ul.reg li:hasText', this).length > 0) {
						if (jQuery(that).hasClass('chosen')) {
							jQuery(".block-numbers ul.pow li", this).text(currentNumber);	//TODO::Support more then 1 power number per row cenario.
						}
					}
				});
			}
		}
		
		
		buildValues();
		fillValues();
		var totalNumRowInputs = numOfChosenNumbersInCurrentInput(jQuery("#send-form .ticket_rows .row.active input.num").val()) +
		numOfChosenNumbersInCurrentInput(jQuery("#send-form .ticket_rows .row.active input.power_num").val());
		if (totalNumRowInputs >= max_row_nums) {// auto switch to next row
			nextRow(1);
		}
		
		updatePrice();
	});
    
	function fillValues(){
		jQuery('.block-numbers').each(function(){
			var array = jQuery.map(jQuery('.reg li:hasText', this), function(elm){return elm.innerHTML});
			var val = array.join(',');
			jQuery('input.num', this).val(val);

			var array = jQuery.map(jQuery('.pow li:hasText', this), function(elm){return elm.innerHTML});
			var val = array.join(',');
			jQuery('input.power_num', this).val(val);
		});
	}
	
	function updatePrice(){
		var filledInputs = countFilledInputs();
		var price = row_price * parseInt(filledInputs);
		var offerPercent = Math.round( (row_subscription_price/row_price) * 100)/100;
		var incentivePrice = Math.round( (price*offerPercent) * 100)/100;
		
		var xx = ((price*offerPercent) * 100) / 100;
//		alert('row price:'+row_price+' subs price: '+row_subscription_price+' filledInputs:'+filledInputs+' price:'+price+ ' inc price:'+xx);
		
		price = Math.round(price*100)/100;
		jQuery("#count-rows").text('');
		jQuery("#count-rows").text(filledInputs);
		jQuery("#ticket-price").text('');
		jQuery("#ticket-price").text(price);
		jQuery("#incentive-price").text('');
		jQuery("#incentive-price").text(incentivePrice);
		jQuery("#send-form input[name='ticket[price]']").val(price);
		jQuery("#send-form input[name='ticket[subscription_price]']").val(incentivePrice);
		jQuery("#send-form input[name='ticket[rows_num]']").val(parseInt(filledInputs));
	}
    
	function countFilledInputs(){
		var counter = 0;
		jQuery("#send-form .ticket_rows .row input.num").each(function(){
			var curr_value_arr = jQuery(this).val().split(',');
			if(curr_value_arr[0] != ''){
				counter++;
			}
		});
		return counter;
	}
    
	// switch rows
	jQuery(".ticket-header .switch-row").click(function(){
		if(jQuery(this).hasClass('prev')){
			nextRow(-1);
		}
		else{ // next
			nextRow(1);
		}
	});


  function storeSelection() {
    var data;
    data = [];
    jQuery(".ticket_rows .row").each(function() {
      var row = jQuery(".num",this).val() + "+" + jQuery(".power_num",this).val();
      if(row.length > 1) {
        data.push(row);
      }
    });
    window.location.hash = data.join("|");
  }

  function loadSelection() {
    var data = window.location.hash;
    data = data.substring(1,data.length);
    if(!data || data.length == 0) {
      return;
    }

		var pow_pick = parseInt(Drupal.settings.lottery['lotteryRowPowerCheckNumPerLine']);
    rows = data.split("|");

		for(var i = 0; i < rows.length; i++){
      var a = rows[i].split("+");
			var reg_rand_nums = a[0];
			var reg_nums = reg_rand_nums.split(',').sort(function(a,b) {return parseFloat(a) - parseFloat(b)} );
			jQuery("#row_"+i+" input.num").val(reg_nums);
			var pow_rand_nums = a[1];
			var pow_nums = pow_rand_nums.split(',').sort(function(a,b) {return parseFloat(a) - parseFloat(b)} );
			jQuery("#row_"+i+" input.power_num").val(pow_nums);
			buildRandValues(reg_nums,pow_pick ? pow_nums : "",i);
		}
		
    //CR GABIL: code duplication
		//Special condition for power ball per ticket.
		//var currentNumber = this.innerHTML;
		if (Drupal.settings.lottery.lotteryPowerNumMarkedPer == "2") {
		
		
	
			jQuery("input.power_num").val(pow_rand_nums);
			jQuery(".block-numbers ul.pow li").text(pow_rand_nums);	//TODO::Support more then 1 power number per row cenario.
		}

		highlightChosenNumbers();
		updatePrice();
    //window.location.hash = "";
  }
  loadSelection();

  jQuery("#send-form").submit(function() {
  
	//Empty not fully completed rows.
	jQuery('.ticket_rows .row').each(function(){
		if (jQuery('li', this).length != jQuery('li:hasText', this).length) {
			jQuery('li', this).text('');
			jQuery('input', this).val('');
		}
	});
	
	updatePrice();
      
      var currentPrice = jQuery("#ticket-price").text();
      var filledInputs = countFilledInputs();
      if( filledInputs >= min_rows ) {
        storeSelection();
      } else {
        alert(Drupal.t("You must fill in at least "+min_rows+" row(s)"));
        return false;
      }
  });


 
     
	jQuery("#quick-fill").click(function(){
		randomNumbers();
		updatePrice();
	});
        
	jQuery("#clear-fill").click(function(){
		jQuery(".row input").val('');
		jQuery(".row .block-numbers ul li").text('');
		jQuery(".lottery_number_list .lottery_number").removeClass('chosen');
		updatePrice();
	});
        
	function randomNumbers(){
		var reg_start =  parseInt(Drupal.settings.lottery['lotteryRowNumMin']);
		var reg_end = parseInt(Drupal.settings.lottery['lotteryRowNumMax']);
		var reg_pick = parseInt(Drupal.settings.lottery['lotteryRowCheckNumPerLine']);
		var reg_tot = reg_end - reg_start + 1;
		var pow_start =  parseInt(Drupal.settings.lottery['lotteryRowPowerNumMin']);
		var pow_end = parseInt(Drupal.settings.lottery['lotteryRowPowerNumMax']);
		var pow_pick = parseInt(Drupal.settings.lottery['lotteryRowPowerCheckNumPerLine']);
		//var pow_tot = pow_end - pow_start + 1;

		for(var i = 0; i < max_input_rows; i++){
			
			//Selected regular numbers.
			var existingNumbersArray = [];
			jQuery("#row_" + i + " .reg li:hasText").each(function(){
				existingNumbersArray.push(this.innerHTML);
			});

			var reg_rand_nums = picks(reg_pick, reg_start, reg_end, existingNumbersArray);
			
			//var reg_nums = reg_rand_nums.split(',').sort(function(a,b) { return parseFloat(a) - parseFloat(b) } );
			jQuery("#row_"+i+" input.num").val(reg_rand_nums);
			
			//Selected power numbers.
			var existingNumbersArray = [];
			jQuery("#row_" + i + " .pow li:hasText").each(function(){
				existingNumbersArray.push(this.innerHTML);
			});
			
			var pow_rand_nums = picks(pow_pick, pow_start, pow_end, existingNumbersArray);
			//var pow_nums = pow_rand_nums.split(',').sort(function(a,b) { return parseFloat(a) - parseFloat(b) } );
			jQuery("#row_"+i+" input.power_num").val(pow_rand_nums);
			buildRandValues(reg_rand_nums,pow_pick ? pow_rand_nums : "",i);
		}
		
		jQuery(".ticket li.chosen").removeClass('chosen');

		//Special condition for power ball per ticket.
		//var currentNumber = this.innerHTML;
		if (Drupal.settings.lottery.lotteryPowerNumMarkedPer == "2") {
			jQuery("input.power_num").val(pow_rand_nums + '');
			jQuery(".block-numbers ul.pow li").text(pow_rand_nums + '');	//TODO::Support more then 1 power number per row cenario.
		}

		highlightChosenNumbers();
	}
        

	function randOrd(){
		return (Math.round(Math.random())-0.5);
	}
    
	function picks(pick, startNum, endNum, existingNumbersArray) {
		var tot = endNum - startNum + 1;
		var ary = [];
		var res = [];

		//Building allowed values array.
		for (var i = endNum; i >= startNum; i--) {
			
			if (existingNumbersArray) {

				if (jQuery.inArray(i + "", existingNumbersArray) >= 0) {
					res.push(i);
				}
				else {
					ary.push(i);
				}
			}
			else {
				ary.push(i);
			}
		}
		
		//Picks an allowed value at random.
		var numsToPick = pick - res.length;
		tot = tot - res.length;
		for (var i = 0; i < numsToPick; i++) {
			rndVal = Math.floor(Math.random()*tot);
			res.push(ary[rndVal]);
			ary[rndVal] = ary[tot-1];
			tot--;
		}

		res = res.sort(function(a,b) {return parseFloat(a) - parseFloat(b)} );
		return res;
	}

	function switchForm(){
		if (jQuery(".lottery .ticket .lucky-numbers .numbers-container").hasClass('active')){
			jQuery(".lottery .ticket .lucky-numbers .numbers-container").removeClass('active');
			jQuery(".lottery .ticket .bonus-numbers .numbers-container").addClass('active');
		}
		else{
			jQuery(".lottery .ticket .bonus-numbers .numbers-container").removeClass('active');
			jQuery(".lottery .ticket .lucky-numbers .numbers-container").addClass('active');
		}
	}
    
	function setActiveInput(activeRow,clickKind){
		jQuery("#send-form .ticket_rows .row input").removeClass('active');
		jQuery(activeRow).children().children('input.'+clickKind).addClass('active');
		return jQuery(activeRow).children().children('input.active');
	}
    
	function nextRow(gotoRow){
		jQuery(".node-lottery-draw .lottery_number_list .lottery_number").removeClass('chosen');
		var active_row = jQuery("#send-form .ticket_rows .row.active");
		jQuery("#send-form .ticket_rows .row").removeClass('active');
		var curr_row = jQuery("#send-form .ticket_rows .row").index(active_row);
		var next_row = curr_row + gotoRow;
		if(next_row >= max_input_rows){
			next_row = 0;
		}
		else if(next_row < 0){
			next_row = max_input_rows - 1;
		}
		jQuery("#send-form .ticket_rows .row.active").removeClass('active');
		jQuery("#row_" + next_row).addClass('active');
		var next_next = next_row + 1;
		var prev_next = next_row - 1;
		if(prev_next < 0){
			jQuery(".ticket-header #prev_row_num").text(digitToChar(max_input_rows - 1));
			jQuery(".ticket-header #row_num").text(digitToChar(next_row));
			jQuery(".ticket-header #next_row_num").text(digitToChar(next_row + 1));
		}
		else if(next_next >= max_input_rows){
			jQuery(".ticket-header #prev_row_num").text(digitToChar(next_row - 1));
			jQuery(".ticket-header #row_num").text(digitToChar(next_row));
			jQuery(".ticket-header #next_row_num").text(digitToChar(0));
		}
		else{
			jQuery(".ticket-header #prev_row_num").text(digitToChar(next_row - 1));
			jQuery(".ticket-header #row_num").text(digitToChar(next_row));
			jQuery(".ticket-header #next_row_num").text(digitToChar(next_row + 1));
		}
		highlightChosenNumbers();
	}

	function digitToChar(dig){
		return String.fromCharCode((dig.toString().charCodeAt(0)+17));
	}
    
	function isInputContainsValue(elem){
		var curr_value_arr = jQuery("#send-form .ticket_rows input.active").val().split(',');
		if(jQuery.inArray(elem, curr_value_arr) != -1){
			return true;
		}
		else{
			return false;
		}
	}
	
	function addOrRemoveChosen(elem){
		if (elem.hasClass('chosen')){
			elem.removeClass('chosen');
		}
		else{
			elem.addClass('chosen');
		}
	}
	
	function addInputValues(active_input){
		var value = '';
		var chosen_items = jQuery(".node-lottery-draw .lottery_number_list .lottery_number."+active_input+".chosen");	

		chosen_items.each(function(){
			value = value + "," + this.innerHTML;
		});
		//Preparing value.
		if (value.length > 0){
			value = value.substr(1, value.length - 1);
		}
		//Inserting value to input
		jQuery("#send-form .ticket_rows input.active").val(value);
	}
	
	function buildRandValues(reg_rand_nums,pow_rand_nums,i){
		var content = '<ul class="reg">';
		for(var index = 0; index < reg_rand_nums.length; index++){
			content += '<li class="reg_'+index+'">' + reg_rand_nums[index] + '</li>';
		}
		content += '</ul>';
		var lucky = '<ul class="pow">';
		for(index = 0; index < pow_rand_nums.length; index++){
			lucky += '<li class="lucky pow_'+index+'">' + pow_rand_nums[index] + '</li>';
		}
		lucky += '</ul>';
		//        content += lucky;
		jQuery("#row_"+i+" .block-numbers ul.reg").remove();
		jQuery("#row_"+i+" .block-numbers").append(content);
		jQuery("#row_"+i+" .block-numbers ul.pow").remove();
		jQuery("#row_"+i+" .block-numbers").append(lucky);
	}
	
	function buildValues(){
		jQuery(".row.active .block-numbers ul li").text('');
		var chosen_items = jQuery(".node-lottery-draw .lottery_number_list .lottery_number.chosen");
		var reg_counter = 0;
		var pow_counter = 0;
		chosen_items.each(function(){
			if(jQuery(this).hasClass('power')){
				jQuery(".row.active .block-numbers ul.pow li[class~='pow_" + pow_counter + "']").text(jQuery(this).text());
				
				pow_counter++;
			}
			else{
				jQuery(".row.active .block-numbers ul.reg li[class~='reg_"+(reg_counter++)+"']").text(jQuery(this).text());
			}
		});
	}
	
	function numOfChosenNumbersInCurrentInput(str){
		if(!str){
			return 0;
		}
		var curr_value_arr = str.split(',');
		if (curr_value_arr == ''){ 
			return 0;
		}
		else{
			return curr_value_arr.length;
		}
	}
	
	function highlightChosenNumbers(){
		var i;

		jQuery("#send-form .ticket_rows .row.active ul li:not(.lucky)").each(function(){
			i = parseInt(jQuery(this).text());
			jQuery("#lottery_ticket_digit_number_" + i).addClass('chosen');
		});

		jQuery("#send-form .ticket_rows .row.active ul li.lucky").each(function(){
			i = parseInt(jQuery(this).text());
			jQuery("#lottery_ticket_digit_power_number_" + i).addClass('chosen');
		});
	}
	
	function nextInputRow(){
		var input_active = jQuery("#send-form .ticket_rows input.active");
		var curr_row = jQuery("#send-form .ticket_rows input").index(input_active);
		var next_row = curr_row + 2;
		if(next_row > max_input_rows){
			return false;
		}
		jQuery("#send-form .ticket_rows input.active").removeClass('active');
		jQuery("#send-form .ticket_rows input:nth-child("+next_row+")").addClass('active');
		return true;
	}
});
