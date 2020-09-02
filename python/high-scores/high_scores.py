"""High Scores exercise from exercism.io python path.

Manage a game player's High Score list.

Returns the highest score from the list, the last added score and
the three highest scores.
"""


def latest(scores):
    """Get last added score.

    Args:
        scores: list of positive integers

    Returns:
        An integer representing the latest score
    """
    return scores[-1]


def personal_best(scores):
    """Get personal high score.

    Args:
        scores: list of positive integers

    Returns:
        An integer representing the highest score
    """
    return max(scores)


def personal_top_three(scores):
    """Get personal top three scores.

    Args:
        scores: list of positive integers

    Returns:
        List of integers representing the three top scores
    """
    return sorted(scores, reverse=True)[:3]
