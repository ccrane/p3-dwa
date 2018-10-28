{{ (old($field, null) != null) ? ((strtoupper(old($field)) == strtoupper($value)) ? "checked" : "") : ((isset($$field) && (strtoupper($$field) == strtoupper($value))) ? "checked" : "") }}
