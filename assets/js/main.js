const myform = document.getElementById('myform');
const profile = document.getElementById('profile');


const showImages = async() => {
    const show_data = document.getElementById('show_img_data');
    const response = await fetch('./backends/upload.php?read=1')
    const result = await response.json();
    let data = ``;
    if (result.length != 0) {
        for (const row of result) {
            data += `<div class="img-box">
                        <img src="./assets/img/${row.img_name}" />
                        <button class="btn btn-delete" data-id="${row.id}" > trash </button>
                    </div>`;
        }
    } else {
        data += `<h3>Images Not Found !!!</h3>`;
    }
    show_data.innerHTML = data;
    deleteImage();
}
showImages();

myform.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData();
    for (let item of profile.files) {
        formData.append('profile[]', item);
    }
    formData.append('img_upload', 1);

    const response = await fetch('./backends/upload.php', {
        method: 'post',
        body: formData
    })

    const result = await response.text();
    myform.reset();
    console.log(result);
    showImages();
})


const deleteImage = e => {
    const btn_delete = document.querySelectorAll('.btn-delete');
    for (const button of btn_delete) {
        button.addEventListener('click', async(e) => {
            e.preventDefault();
            let id = e.target.dataset.id;
            const response = await fetch(`./backends/upload.php?id=${id}&delete=1`);
            const result = await response.text();
            console.log(result);
            showImages();
        })
    }
}