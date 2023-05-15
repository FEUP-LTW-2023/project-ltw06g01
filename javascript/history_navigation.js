const prevButton = document.querySelector('#prev-button')
const nextButton = document.querySelector('#next-button')
const department = document.querySelector('#department option')
const title = document.querySelector('#subject')
const text = document.querySelector('#tickettext')
const messages = document.querySelector('#messages')
const addMessage = document.querySelector('#add-message')
const tID = document.querySelector('#tid')

let currID = tID.getAttribute('value')
const initialID = currID


prevButton.addEventListener('click', async function() {
    const response = await fetch('../api/api_ticket.php?id=' + currID)
    const ticket = await response.json()

    let prevID = ticket.prev
    if (prevID === null) return
    currID = prevID

    if (currID === initialID) {
        addMessage.style.display = 'block'
    }
    else addMessage.style.display = 'none'

    department.setAttribute('value', ticket.department)
    title.setAttribute('value', ticket.title)
    text.textContent = ticket.text
})