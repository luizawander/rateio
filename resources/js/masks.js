export function clean(value) {
    if (value === null || value === undefined) return '';
    return value.toString().replace(/\D/g, '');
}

export function phone(value) {
    if (!value) return '';
    let cleaned = clean(value);
    
    cleaned = cleaned.slice(0, 11);
    
    if (cleaned.length > 6) {
        return `(${cleaned.slice(0, 2)}) ${cleaned.slice(2, 7)}-${cleaned.slice(7)}`;
    } else if (cleaned.length > 2) {
        return `(${cleaned.slice(0, 2)}) ${cleaned.slice(2)}`;
    } else if (cleaned.length > 0) {
        return `(${cleaned}`;
    }
    return '';
}

export function money(value) {
    if (value === null || value === undefined || value === '') return '';
    
    let cleaned = '';
    if (typeof value === 'number') {
        cleaned = Math.round(value * 100).toString();
    } else {
        cleaned = clean(value);
    }
    
    if (cleaned === '') return '';
    
    cleaned = cleaned.replace(/^0+/, '');
    if (cleaned.length === 0) cleaned = '0';
    if (cleaned.length === 1) cleaned = '0' + cleaned;
    
    let integerPart = cleaned.slice(0, -2) || '0';
    let centsPart = cleaned.slice(-2);
    
    let formattedInteger = parseInt(integerPart, 10).toLocaleString('pt-BR');
    
    return `R$ ${formattedInteger},${centsPart}`;
}

export function cleanMoney(value) {
    if (!value) return 0;
    let cleaned = clean(value);
    if (!cleaned) return 0;
    return parseFloat(cleaned) / 100;
}

export function cpf(value) {
    if (!value) return '';
    let cleaned = clean(value).slice(0, 11);
    
    if (cleaned.length > 9) {
        return `${cleaned.slice(0, 3)}.${cleaned.slice(3, 6)}.${cleaned.slice(6, 9)}-${cleaned.slice(9)}`;
    } else if (cleaned.length > 6) {
        return `${cleaned.slice(0, 3)}.${cleaned.slice(3, 6)}.${cleaned.slice(6)}`;
    } else if (cleaned.length > 3) {
        return `${cleaned.slice(0, 3)}.${cleaned.slice(3)}`;
    }
    return cleaned;
}

export function cnpj(value) {
    if (!value) return '';
    let cleaned = clean(value).slice(0, 14);
    
    if (cleaned.length > 12) {
        return `${cleaned.slice(0, 2)}.${cleaned.slice(2, 5)}.${cleaned.slice(5, 8)}/${cleaned.slice(8, 12)}-${cleaned.slice(12)}`;
    } else if (cleaned.length > 8) {
        return `${cleaned.slice(0, 2)}.${cleaned.slice(2, 5)}.${cleaned.slice(5, 8)}/${cleaned.slice(8)}`;
    } else if (cleaned.length > 5) {
        return `${cleaned.slice(0, 2)}.${cleaned.slice(2, 5)}.${cleaned.slice(5)}`;
    } else if (cleaned.length > 2) {
        return `${cleaned.slice(0, 2)}.${cleaned.slice(2)}`;
    }
    return cleaned;
}
