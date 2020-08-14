def convert(number):
    result = str(number)

    if number % 3 == 0:
        result = "Pling"

    if number % 5 == 0:
        result += "Plang"

    if number % 7 == 0:
        result += "Plong"

    if not result.isdigit():
        result = result.replace(str(number), "")

    return result
