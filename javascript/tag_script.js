const tagBox = document.querySelector('.tags')
const tags = tagBox.querySelectorAll('.tag')
const allTags = document.querySelector('#taglist')
const addButton = document.querySelector('.tag-add')
const tagInput = document.querySelector('.tag-input')
const tagList = []

allTags.querySelectorAll('option').forEach((option) => {
    tagList.push(option.textContent)
})

console.log(tagList)

function tagSetup(tag) {
    const x = tag.querySelector('.tag-delete')
    x.addEventListener('click', (e) => {
        tag.remove()
    })
}

tags.forEach((tag) => tagSetup(tag))

addButton.addEventListener('click', (e) => {
    const newTag = tagInput.value 
    if (tagList.includes(newTag)) {
        const tagNode = document.createElement('div')
        const newButton = document.createElement('span')

        newButton.classList.add('tag-delete')
        newButton.textContent = "X"

        tagNode.classList.add('tag')
        tagNode.textContent = newTag + " "

        tagNode.appendChild(newButton)
        tagSetup(tagNode)
        
        tagBox.appendChild(tagNode)
    }
})