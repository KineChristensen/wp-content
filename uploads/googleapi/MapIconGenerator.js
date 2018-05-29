import fontawesome from '@fortawesome/fontawesome'
import brands from '@fortawesome/fontawesome-free-brands'
import solid from '@fortawesome/fontawesome-free-solid'
import regular from '@fortawesome/fontawesome-free-regular'

fontawesome.library.add(brands)
fontawesome.library.add(solid)
fontawesome.library.add(regular)

const config = {
  size: 78,
  strokeWidth: 3,
  font: {
    family: 'Roboto Slab',
    weight: 700,
    size: 36
  }
}

const font = config.font.weight + ' ' + config.font.size + 'px ' + config.font.family

const defaultTheme = {

}

const themes = {
    noBikes: {
    background: '#5F0000',
    border: '#005FD1',
    text: '#FFFFFF'
  },
  defaultTheme: {
    background: '#005FD1',
    border: '#005FD1',
    text: '#FFFFFF'
  }
}


const fontAwesomeFonts = {
  fab: {
    family: 'Font Awesome 5 Brands',
    weight: 'normal'
  },
  fas: {
    family: 'Font Awesome 5 Pro',
    weight: 900
  },
  far: {
    family: 'Font Awesome 5 Pro',
    weight: 400
  },
  fal: {
    family: 'Font Awesome 5 Pro',
    weight: 300
  }
}

const fontAwesomeCache = {}
const textCache = {}

const isFontAwesome = (text) => {
  return Object.keys(fontAwesomeFonts).some(val => text.includes(val))
}

const normalizeIconArgs = (icon) => {
  if (icon === null) {
    return null
  }

  if (typeof icon === 'object' && icon.prefix && icon.iconName) {
    return icon
  }

  if (Array.isArray(icon) && icon.length === 2) {
    return { prefix: icon[0], iconName: icon[1] }
  }

  if (typeof icon === 'string') {
    const prefix = Object.keys(fontAwesomeFonts).filter(val => icon.includes(val))[0]
    return { prefix, iconName: icon.replace(prefix, '').trim() }
  }
}

const getFontAwesomeIcon = (icon, theme) => {
  const id = `${icon.prefix}:${icon.iconName}:${theme.text}`
  if (typeof fontAwesomeCache[id] === 'object') { return fontAwesomeCache[id] }
  icon = fontawesome.icon(icon)
  if (typeof icon === 'undefined') {
    return null
  }
  const canvas = document.createElement('canvas')
  const higestValue = Math.max(icon.icon[0], icon.icon[1])
  const ratio = config.font.size / higestValue
  canvas.width = (icon.icon[0] * ratio)
  canvas.height = (icon.icon[1] * ratio)
  const context = canvas.getContext('2d')
  context.fillStyle = theme.text
  context.strokeStyle = theme.text
  const path = new Path2D(icon.icon[4])
  context.scale(ratio, ratio)
  context.fill(path)
  fontAwesomeCache[id] = {
    canvas,
    width: (icon.icon[0] * ratio),
    height: (icon.icon[1] * ratio)
  }
  return fontAwesomeCache[id]
}

const textDimension = function (text, font, radius) {
  const id = text + ':' + font + ':' + radius
  if (typeof textCache[id] === 'object') { return textCache[id] }
  const canvas = document.createElement('canvas')
  canvas.width = radius
  canvas.height = radius
  const context = canvas.getContext('2d')
  context.font = font
  context.fillStyle = '#000'
  const x = 10
  context.fillText(text, x, radius - 20)
  const textData = context.getImageData(0, 0, radius, radius).data
  let c = radius + 1
  let l = -1
  let f = -1
  let d = radius + 1
  for (let h = 0; h < radius; h++) {
    for (let p = 0; p < radius; p++) {
      let m = 4 * (h * radius + p)
      let g = textData[m]
      let v = textData[m + 1]
      let y = textData[m + 2]
      let b = textData[m + 3]
      if (!(g === 0 && v === 0 && y === 0 && b === 0)) {
        if (c > p) {
          c = p
        }
        if (l < p) {
          l = p
        }
        if (d > h) {
          d = h
        }
        if (f < h) {
          f = h
        }
      }
    }
  }
  const width = l - c
  const height = f - d
  textCache[id] = {
    width,
    height,
    xDelta: c - x
  }
  return textCache[id]
}

const generateCircle = (theme) => {
  const canvas = document.createElement('canvas')
  canvas.width = config.size
  canvas.height = config.size
  const context = canvas.getContext('2d')
  context.beginPath()
  context.fillStyle = theme.background
  context.strokeStyle = theme.border
  context.lineWidth = config.strokeWidth
  context.arc(config.size / 2, config.size / 2, config.size / 2 - config.strokeWidth / 2, 0, 2 * Math.PI, !1)
  context.fill()
  context.stroke()
  return canvas
}

export default function (text = null, theme = defaultTheme) {
  text = '' +text
  if (text === '0') {
    theme = themes.noBikes;
  }
  else{
    theme = themes.defaultTheme
  }

  const circle = generateCircle(theme)
  if (isFontAwesome(text)) {
    text = normalizeIconArgs(text)
    if (text.iconName.trim() !== '') {
      const icon = getFontAwesomeIcon(text, theme)
      if (icon === null) {
        return null
      }
      const context = circle.getContext('2d')
      context.drawImage(icon.canvas, config.size / 2 - icon.width / 2, config.size / 2 - icon.height / 2)
    }
  } else if (text !== null) {
    const context = circle.getContext('2d')
    text = text.substring(0, 3)
    context.beginPath()
    context.font = font
    const textSize = textDimension(text, font, config.size)
    context.fillStyle = theme.text
    context.fillText(text, config.size / 2 - textSize.width / 2 - textSize.xDelta, config.size / 2 + textSize.height / 2)
  }
  return {
    url: circle.toDataURL(),
    scaledSize: {
      height: config.size / 3,
      width: config.size / 3
    }
  }
}
