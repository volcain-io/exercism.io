class SimpleCipher {
    readonly key: string
    readonly min: number = 'a'.charCodeAt(0)
    readonly bound: number = 'z'.charCodeAt(0) - this.min + 1

    constructor(key?: string) {
        if (key === '' || (key && key.match(/[^a-z]/g))) {
            throw new Error('Bad key')
        }
        if (key === undefined) {
            this.key = this.generateKey()
        } else {
            this.key = key
        }
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
            return this.getCharAt((ch.charCodeAt(0) + k) % this.min)
        }).join('')
    }

    private getCharAt(charCode: number): string {
        if (charCode < 0) { charCode += this.bound }
        if (charCode >= this.bound) { charCode -= this.bound }
        return String.fromCharCode(charCode + this.min)
    }

    private generateKey(): string {
        let key: string = ''
        while (key.length <= 100) {
            const rand = Math.floor(Math.random() * this.bound) + this.min
            key += String.fromCharCode(rand)
        }
        return key
    }
}

export default SimpleCipher
