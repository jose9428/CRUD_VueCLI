export function soloLetras(value) {
    const expresion = /^[A-Za-z Ññ]+$/
    return expresion.test(value);
}

export function formatoFecha(value) {
    const expresion =/^\d{4}-\d{2}-\d{2}$/
    return expresion.test(value);
}

export const contenga = (value) => value.includes('test')    