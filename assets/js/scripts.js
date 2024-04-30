// Atualiza a imagem de perfil quando um novo arquivo é selecionado
document.getElementById("image-upload").addEventListener("change", function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var imgElement = document.getElementById("profile-img");
        imgElement.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});
