<?php

class LinkCard
{
    private string $title;
    private string $description;
    private string $url;
    private string $domain;

    public function __construct(string $title, string $description, string $url, string $domain)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->domain = $domain;
    }

    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer">
        <div class="link-card-content">
            <h3 class="link-card-title">{$escapedTitle}</h3>
            <p class="link-card-description">{$escapedDescription}</p>
            <span class="link-card-domain">{$escapedDomain}</span>
        </div>
    </a>
</div>
HTML;
    }

    public static function createDefault(): self
    {
        return new self(
            '乐鱼体育 - 精彩赛事在线观看',
            '乐鱼体育提供最新体育赛事直播、赛程数据与专业分析，涵盖足球、篮球、网球等热门项目。',
            'https://h5-portal-leyu.com.cn',
            'h5-portal-leyu.com.cn'
        );
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['title'] ?? '无标题',
            $data['description'] ?? '',
            $data['url'] ?? '#',
            $data['domain'] ?? ''
        );
    }
}

function renderLinkCard(string $title, string $description, string $url, string $domain): string
{
    $card = new LinkCard($title, $description, $url, $domain);
    return $card->render();
}

function renderLinkCardFromArray(array $data): string
{
    $card = LinkCard::createFromArray($data);
    return $card->render();
}

// 示例：直接输出默认卡片
$card = LinkCard::createDefault();
echo $card->render();

// 示例：自定义卡片
$customCard = renderLinkCard(
    '乐鱼体育 - 电竞与体育综合平台',
    '汇聚全球顶级赛事，乐鱼体育为你带来沉浸式观赛体验。',
    'https://h5-portal-leyu.com.cn',
    'h5-portal-leyu.com.cn'
);
echo $customCard;