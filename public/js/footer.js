window.addEventListener("DOMContentLoaded", (event) => {
  const isMitra = document.body.querySelector("#isMitraYes");
  const noMitra = document.body.querySelector("#isMitraNo");
  const jumlahMitra = document.body.querySelector("#jumlahMitra");

  if (isMitra) {
    isMitra.addEventListener("click", function(){
      if (isMitra.checked == true) {
        console.log(true)
        jumlahMitra.style.display="block"
      }
    })
    noMitra.addEventListener("click", function(){
      if (noMitra.checked == true) {
        console.log(false)
        jumlahMitra.style.display="none";
      } 
    })
  }
});