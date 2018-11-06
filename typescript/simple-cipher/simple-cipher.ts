class SimpleCipher {
    readonly key: string
    private static min: number = 'a'.charCodeAt(0)
    private static bound: number = 'z'.charCodeAt(0) - SimpleCipher.min + 1

    constructor(key?: string) {
        if (key === '' || (key && key.match(/[^a-z]/g))) {
            throw new Error('Bad key')
        }
        this.key = key || this.generateKey()
    }

    encode(value: string): string {
        return this.encrypt(value)
    }

    decode(value: string): string {
        return this.encrypt(value, true)
    }

    private encrypt(value: string, reverse = false): string {
        return value.split('').map((ch, idx) => {
            let k = this.key[idx % this.key.length].charCodeAt(0)
            if (reverse) { k = -k }
            return this.getCharAt((ch.charCodeAt(0) + k) % SimpleCipher.min)
        }).join('')
    }

    private getCharAt(charCode: number): string {
        if (charCode < 0) { charCode += SimpleCipher.bound }
        if (charCode >= SimpleCipher.bound) { charCode -= SimpleCipher.bound }
        return String.fromCharCode(charCode + SimpleCipher.min)
    }

    private generateKey(): string {
        return [...Array(100)]
            .map((ch) => ch = String.fromCharCode(Math.floor(Math.random() * SimpleCipher.bound) + SimpleCipher.min))
            .join('')
    }
}

export default SimpleCipher
