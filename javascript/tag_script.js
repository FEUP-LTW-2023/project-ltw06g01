const tagBox = document.querySelector('.tags')
const tags = tagBox.querySelectorAll('.tag')

tags.forEach((tag) => {
    const x = tag.querySelector('.tag-delete')
    x.addEventListener('click', (e) => {
        tag.remove()
    })
})