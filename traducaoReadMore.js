let elementos = document.querySelectorAll("a.read-more");
console.log(elementos);
elementos.forEach(link=>{
    console.log(link);
    link.textContent = "Leia Mais";

});