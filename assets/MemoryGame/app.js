document.addEventListener('DOMContentLoaded', () => {
  //card options
  const cardArray = [
    {
      name: 'machamp',
      img: 'images/machamp.png'
    },
    {
      name: 'charizard',
      img: 'images/charizard.png'
    },
    {
      name: 'pikachu',
      img: 'images/pikachu.png'
    },
    {
      name: 'machamp',
      img: 'images/machamp.png'
    },
    {
      name: 'charizard',
      img: 'images/charizard.png'
    },
    {
      name: 'blastoise',
      img: 'images/blastoise.png'
    },
    {
      name: 'venusaur',
      img: 'images/venusaur.png'
    },
    {
      name: 'mewtwo',
      img: 'images/mewtwo.png'
    },
    {
      name: 'pikachu',
      img: 'images/pikachu.png'
    },
    {
      name: 'blastoise',
      img: 'images/blastoise.png'
    },
    {
      name: 'mewtwo',
      img: 'images/mewtwo.png'
    },
    {
      name: 'venusaur',
      img: 'images/venusaur.png'
    }
  ]

  cardArray.sort(() => 0.5 - Math.random())

  const grid = document.querySelector('.grid')
  const resultDisplay = document.querySelector('#result')
  var cardsChosen = []
  var cardsChosenId = []
  const cardsWon = []

  //create your board
  function createBoard() {
    for (let i = 0; i < cardArray.length; i++) {
      var card = document.createElement('img')
      card.setAttribute('src', 'images/pokeball.png')
      card.setAttribute('data-id', i)
      card.addEventListener('click', flipCard)
      grid.appendChild(card)
    }
  }

  //check for matches
  function checkForMatch() {
    var cards = document.querySelectorAll('img')
    const optionOneId = cardsChosenId[0]
    const optionTwoId = cardsChosenId[1]

    if(optionOneId == optionTwoId) {
      cards[optionOneId].setAttribute('src', 'images/pokeball.png')
      cards[optionTwoId].setAttribute('src', 'images/pokeball.png')
      alert('You have clicked the same image!')
    }
    else if (cardsChosen[0] === cardsChosen[1]) {
      alert('You found a match')
      cards[optionOneId].setAttribute('src', 'images/white.png')
      cards[optionTwoId].setAttribute('src', 'images/white.png')
      cards[optionOneId].removeEventListener('click', flipCard)
      cards[optionTwoId].removeEventListener('click', flipCard)
      cardsWon.push(cardsChosen)
    } else {
      cards[optionOneId].setAttribute('src', 'images/pokeball.png')
      cards[optionTwoId].setAttribute('src', 'images/pokeball.png')
      alert('Sorry, try again')
    }
    cardsChosen = []
    cardsChosenId = []
    resultDisplay.textContent = cardsWon.length
    if  (cardsWon.length === cardArray.length/2) {
      resultDisplay.textContent = 'Congratulations! You found them all!'
    }
  }

  //flip your card
  function flipCard() {
    var cardId = this.getAttribute('data-id')
    cardsChosen.push(cardArray[cardId].name)
    cardsChosenId.push(cardId)
    this.setAttribute('src', cardArray[cardId].img)
    if (cardsChosen.length ===2) {
      setTimeout(checkForMatch, 500)
    }
  }

  createBoard()
})
