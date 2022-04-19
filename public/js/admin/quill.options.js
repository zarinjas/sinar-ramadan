document.addEventListener('orchid:quill', (event) => {

    // Parameter object for initialization
    event.detail.options = {
        theme: 'bubble',
        placeholder: 'Compose an epic...',
        readOnly: true,
    };
});