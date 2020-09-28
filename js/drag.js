
function drag(event) {
  event.dataTransfer.setData
  ('target_id',event.target.id);
}
function allowDrop(event){
event.preventDefault();
}
function drop(event) {
  event.preventDefault(); 

  var drop_target = event.target;
  var drag_target_id = event.dataTransfer.getData('target_id');
  var sourceThemeId = drag_target_id;

  var drag_target = $('#'+drag_target_id)[0];

  var tmp = document.createElement('div');
  tmp.className='hide';
  drop_target.before(tmp);
  drag_target.before(drop_target);
  tmp.replaceWith(drag_target);

  data = {
      firstThemeId : sourceThemeId,
      secondThemeId: drop_target.id,
      action :'themeDragged'    
  };  

  $.ajax({
      url:'../scripts/interface.php',
      type:'POST',
      data : data,
      'success' :function(){}
  });

}
