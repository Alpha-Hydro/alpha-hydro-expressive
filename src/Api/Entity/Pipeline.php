<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pipeline
 *
 * @ORM\Table(name="pipeline", uniqueConstraints={@ORM\UniqueConstraint(name="unique_id", columns={"id"}), @ORM\UniqueConstraint(name="unique_full_path", columns={"full_path"})})
 * @ORM\Entity
 */
class Pipeline
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    private $path = '';

    /**
     * @var string
     *
     * @ORM\Column(name="full_path", type="string", length=255, nullable=false)
     */
    private $fullPath = '';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="content_html", type="text", length=65535, nullable=true)
     */
    private $contentHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="content_markdown", type="text", length=65535, nullable=true)
     */
    private $contentMarkdown;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", length=65535, nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=255, nullable=true)
     */
    private $metaKeywords;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="sorting", type="integer", nullable=false)
     */
    private $sorting = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="image_draft", type="string", length=255, nullable=true)
     */
    private $imageDraft;

    /**
     * @var string
     *
     * @ORM\Column(name="image_table", type="string", length=255, nullable=true)
     */
    private $imageTable;

    /**
     * @var string
     *
     * @ORM\Column(name="gost_name", type="string", length=255, nullable=true)
     */
    private $gostName;


}

