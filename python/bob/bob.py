import re


def hey(phrase):
    msg = phrase.strip()

    if is_yelling_question(msg):
        return "Calm down, I know what I'm doing!"
    elif is_yelling(msg):
        return "Whoa, chill out!"
    elif is_question(msg):
        return "Sure."
    elif is_mute(msg):
        return "Fine. Be that way!"
    else:
        return "Whatever."


def is_yelling_question(phrase):
    return is_question(phrase) and is_yelling(phrase)


def is_question(phrase):
    return phrase.endswith('?')


def is_yelling(phrase):
    return phrase.isupper()


def is_mute(phrase):
    return not phrase
