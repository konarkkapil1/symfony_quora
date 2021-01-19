console.log("loaded");
function like(id){
  $.ajax({
     url: '/question/like/'+ id
  })
      .then(data => {
          console.log(data);
          $(".question-likes-count").text(data.likes);
      })
      .catch(error => console.log(error))
}