const tagBox = document.querySelector('.tags')
const tags = tagBox.querySelectorAll('.tag')

function tagSetup(tag) {
    const x = tag.querySelector('.tag-delete')
    x.addEventListener('click', (e) => {
        tag.remove()
    })
}

tags.forEach((tag) => tagSetup(tag))