import re


def hey(phrase):
    response = {
        'question': "Sure.",
        'yelling': "Whoa, chill out!",
        'yellingQuestion': "Calm down, I know what I'm doing!",
        'mute': "Fine. Be that way!",
        'default': "Whatever."
    }

    # strip all whitespaces
    msg = phrase.strip()

    if isYellingQuestion(msg):
        return response['yellingQuestion']

    if isYelling(msg):
        return response['yelling']

    if isQuestion(msg):
        return response['question']

    if isMute(msg):
        return response['mute']

    return response['default']


def isYellingQuestion(phrase):
    return isQuestion(phrase) and isYelling(phrase)


def isQuestion(phrase):
    return re.match(r'^.+\?$', phrase)


# matches any message which
# starts with uppercase letters or numbers ^[A-Z0-9]
# and does not contain lowercase letters (?![a-z])
# and ends with uppercase letters or exclamation mark or question mark [A-Z!?]+$
def isYelling(phrase):
    return re.match(r'^[A-Z0-9]((?![a-z]).+)[A-Z!?]+$', phrase)


def isMute(phrase):
    return not phrase
