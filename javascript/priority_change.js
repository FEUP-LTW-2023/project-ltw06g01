const priorityBoxes = document.querySelectorAll('.priority-box')

priorityBoxes.forEach((element) => {
    const tID = element.querySelector('.tid').value
    const priorityValue = element.querySelector('.priority')
    const csrf = element.querySelector('.csrf').value
    const incrementButton = element.querySelector('.increment-priority')
    const decrementButton = element.querySelector('.decrement-priority')

    incrementButton.onclick = async function() {
        const priority = parseInt(priorityValue.value, 10) + 1
        const params = {'priority': priority, 'id': tID, 'csrf': csrf}
        const response = await fetch('../api/api_change_priority.php?' + new URLSearchParams(params).toString())
        const json = await response.json()
        priorityValue.value = json
        updatePriorityColor(this)
    }

    decrementButton.onclick = async function() {
        const priority = parseInt(priorityValue.value, 10) - 1
        const params = {'priority': priority, 'id': tID, 'csrf': csrf}
        const response = await fetch('../api/api_change_priority.php?' + new URLSearchParams(params).toString())
        const json = await response.json()
        priorityValue.value = json
        updatePriorityColor(this)
    }

    updatePriorityColor(incrementButton)
})

function updatePriorityColor(button) {
    const priorityBox = button.closest('.priority-box')
    const priorityValue = priorityBox.querySelector('.priority')
    const incrementButton = priorityBox.querySelector('.increment-priority')
    const decrementButton = priorityBox.querySelector('.decrement-priority')
    const priority = parseInt(priorityValue.value)

    if (priority === 0) {
        incrementButton.style.backgroundColor = '#008000bf'
        decrementButton.style.backgroundColor = '#008000bf'
    } else if (priority === 1) {
        incrementButton.style.backgroundColor = 'rgb(255 255 0 / 86%)'
        decrementButton.style.backgroundColor = 'rgb(255 255 0 / 86%)'
    } else if (priority === 2) {
        incrementButton.style.backgroundColor = '#ffa500ba'
        decrementButton.style.backgroundColor = '#ffa500ba'
    } else if (priority === 3) {
        incrementButton.style.backgroundColor = '#ff0000ba'
        decrementButton.style.backgroundColor = '#ff0000ba'
    }
}
