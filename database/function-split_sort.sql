CREATE FUNCTION `SPLIT_SORT`(inString TEXT, inSeparator TEXT)
 RETURNS text CHARSET utf8
BEGIN
  DECLARE strings INT DEFAULT 0;     -- number of substrings
  DECLARE forward INT DEFAULT 1;     -- index for traverse forward thru substrings
  DECLARE backward INT;   -- index for traverse backward thru substrings, position in calc. substrings
  DECLARE remain TEXT;               -- work area for calc. no of substrings
-- swap areas TEXT for string compare, INT for numeric compare
  DECLARE swap1 TEXT;                 -- left substring to swap
  DECLARE swap2 TEXT;                 -- right substring to swap

  SET remain = inString;
  SET backward = LOCATE(inSeparator, remain);
  WHILE backward != 0 DO
    SET strings = strings + 1;
    SET backward = LOCATE(inSeparator, remain);
    SET remain = SUBSTRING(remain, backward+1);
  END WHILE;
  IF strings < 2 THEN RETURN inString; END IF;
  REPEAT
    SET backward = strings;
    REPEAT
      SET swap1 = SUBSTRING_INDEX(SUBSTRING_INDEX(inString,inSeparator,backward-1),inSeparator,-1);
      SET swap2 = SUBSTRING_INDEX(SUBSTRING_INDEX(inString,inSeparator,backward),inSeparator,-1);
      IF  swap1 > swap2 THEN
        SET inString = TRIM(BOTH inSeparator FROM CONCAT_WS(inSeparator
        ,SUBSTRING_INDEX(inString,inSeparator,backward-2)
        ,swap2,swap1
        ,SUBSTRING_INDEX(inString,inSeparator,(backward-strings))));
      END IF;
      SET backward = backward - 1;
    UNTIL backward < 2 END REPEAT;
    SET forward = forward +1;
  UNTIL forward + 1 > strings
  END REPEAT;
RETURN inString;
END;