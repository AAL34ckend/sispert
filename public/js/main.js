function goBack() {
    window.history.back();

    // Get the current URL of the previous page
    const previousUrl = document.referrer;

    // If the previous URL exists, reload it to refresh the page
    if (previousUrl) {
        window.location.href = previousUrl;
    }
}

function setErrors(errors) {
    Object.entries(errors).forEach(([name, errors]) => {
        $(`input[name="${name}"]`).addClass('is-invalid')
        errors.forEach(error => {
            $(`input[name="${name}"]`).parent().append(`
                <div class="invalid-feedback">${error}</div>
            `)
        })
    })
}

$(document).ready(function () {
    $('.form-avatar').click(function (e) {

        const input = $(this).find('input[type="file"]')[0];
        console.log(input);

        input.addEventListener('click', (e) => {
            e.stopPropagation();
        });

        input.click();

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const blobUrl = URL.createObjectURL(file);
            $(this).find('img').remove();
            $(this).append(`<img src="${blobUrl}" alt="${file.name}" />`);
        });
    });
});
