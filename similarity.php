<?php
$text1 = "Bachelor of Science in Computer Engineering";
$text2 = "Bachelor of Science in Civil Engineering";

$stopWords = ["a", "an", "the", "of", "in", "on", "at", "for", "with", "to", "by", "and", "from"];

function getFilteredWords($text, $stopWords) {
    $words = explode(" ", strtolower($text));
    return array_diff($words, $stopWords);
}

$words1 = getFilteredWords($text1, $stopWords);
$words2 = getFilteredWords($text2, $stopWords);

$commonWords = array_intersect($words1, $words2);
$matchCount = count($commonWords);

// Word-based similarity percentage
$totalWords = count(array_unique(array_merge($words1, $words2)));
$wordSimilarity = $totalWords > 0 ? ($matchCount / $totalWords) * 100 : 0;

echo "Similarity Index: " . round($wordSimilarity, 2) . "%<br>";
echo "Number of matching words (excluding stop words): " . $matchCount . "<br>";
echo "Matching words: " . implode(", ", $commonWords);
?>
