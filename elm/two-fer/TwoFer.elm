module TwoFer exposing (twoFer)


twoFer : Maybe String -> String
twoFer name =
    case name of
        Just value ->
            "One for " ++ value ++ ", one for me."

        Nothing ->
            "One for you, one for me."



-- case name of
--     Just value ->
--     Nothing ->
