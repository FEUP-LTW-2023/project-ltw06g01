const priorityBoxes = document.querySelectorAll('.status-box')

priorityBoxes.forEach((element) => {
    const tID = element.querySelector('.tid').value
    const priorityValue = element.querySelector('.priority')
    const csrf = element.querySelector('.csrf').value
    const incrementButton = element.querySelector('.increment-priority')
    const decrementButton = element.querySelector('.decrement-priority')

    incrementButton.addEventListener('click', async function () {
        const priority = parseInt(priorityValue.value, 10) + 1
        const response = await fetch('../api/api_change_priority.php?priority=' + priority + '&id=' + tID + '&csrf=' + csrf)
        priorityValue.value = priority
    })

    decrementButton.addEventListener('click', async function () {
        const priority = parseInt(priorityValue.value, 10) - 1
        const response = await fetch('../api/api_change_priority.php?priority=' + priority + '&id=' + tID + '&csrf=' + csrf)
        priorityValue.value = priority
    })
})