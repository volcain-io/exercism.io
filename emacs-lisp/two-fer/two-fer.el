;;; two-fer.el --- Two-fer Exercise (exercism)

;;; Commentary:
;; Two-fer or 2-fer is short for two for one. One for you and one for me.

;;; Code:
(defun two-fer (&optional name)
  "Prints the sentence 'One for X, one for me.', where 'X' is the given name."
  (if (equal name nil)
      (setq name "you"))
  (format "One for %s, one for me." name)
  )

(provide 'two-fer)
;;; two-fer.el ends here
