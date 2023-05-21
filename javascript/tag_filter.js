const allTags = document.querySelector('#taglist')
const tagString = document.querySelector('#tag-string')
const addButton = document.querySelector('#tag-toggle')
const inputTag = document.querySelector("#ticket-filter-tag")
const tagList = []

allTags.querySelectorAll('option').forEach((option) => {
    tagList.push(option.textContent)
})

addButton.onclick = function() {
    const newTag = inputTag.value 
    if (tagList.includes(newTag)) {
        if (tagString.value.includes(newTag)) {
            tagString.value = tagString.value.replace(newTag, '').replace(/^,/, '').replace(/,,/, ',').replace(/,$/, '')
        }
        else {
            tagString.value += (',' + newTag)
            tagString.value = tagString.value.replace(/^,/, '')
        }
    }
}