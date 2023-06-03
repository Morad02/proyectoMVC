document.getElementById('inputImagenes').addEventListener('change', function(event) {
    var previewContainer = document.getElementById('previewImagenes');

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
    var file = files[i];
    if (!file.type.startsWith('image/')) {
    continue;
}

    var reader = new FileReader();

    reader.onload = (function(file) {
    return function(event) {

    var container = document.createElement('div');
    container.style.width = '150px';
    container.style.margin = '10px';


    var img = document.createElement('img');
    img.src = event.target.result;
    img.classList.add('img-thumbnail');
    img.style.width = '100%';
    img.style.height = 'auto';
    container.appendChild(img);


    var name = document.createElement('p');
    name.textContent = file.name.length > 10 ? file.name.substring(0, 10) + '...' : file.name;
    name.style.overflow = 'hidden';
    name.style.whiteSpace = 'nowrap';
    name.style.textOverflow = 'ellipsis';
    container.appendChild(name);


    previewContainer.appendChild(container);
};
})(file);

    reader.readAsDataURL(file);
}
});
  

    