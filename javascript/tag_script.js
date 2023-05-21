const tagBox = document.querySelector('.tags')

if (tagBox !== null) {
    const tags = tagBox.querySelectorAll('.tag')
    const allTags = document.querySelector('#taglist')
    const addButton = document.querySelector('.tag-add')
    const tagInput = document.querySelector('.tag-input')
    const tagList = []
    const tagString = document.querySelector('.curr-tags')


    allTags.querySelectorAll('option').forEach((option) => {
        tagList.push(option.textContent)
    })

    function tagSetup(tag) {
        const x = tag.querySelector('.tag-delete')
        x.onclick = function() {
            {
                const tagName = tag.textContent.slice(0, -5)
                tagString.value = tagString.value.replace(tagName, '').replace(/^,/, '').replace(/,,/, ',').replace(/,$/, '')
                
                tag.remove()
            }
        }
    }

    tags.forEach((tag) => tagSetup(tag))

    addButton.onclick = function() {
        const newTag = tagInput.value 

        const currTags = Array.from(tagBox.querySelectorAll('.tag')).map(node => node.textContent.slice(0, -2))
        if (!currTags.includes(newTag)) {
            const tagNode = document.createElement('div')
            const newButton = document.createElement('span')

            newButton.classList.add('tag-delete')
            newButton.textContent = "X"

            tagNode.classList.add('tag')
            tagNode.textContent = newTag + " "

            tagNode.appendChild(newButton)
            tagSetup(tagNode)

            tagString.value += (',' + newTag)
            tagString.value = tagString.value.replace(/^,/, '')
            
            tagBox.appendChild(tagNode)
        }
        if (!tagList.includes(newTag)) {
            const createdTag = document.createElement('option')
            createdTag.textContent = newTag
            allTags.appendChild(createdTag)
        }
    }
}    